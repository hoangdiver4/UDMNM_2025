<?php
// Form viết bài mới (shortcode: [user_post_form])
function user_post_frontend_form() {
    if (!is_user_logged_in()) {
        return '<p>Bạn cần <a href="' . wp_login_url() . '">đăng nhập</a> để gửi bài.</p>';
    }
    ob_start();
    ?>
    <form method="post" enctype="multipart/form-data" class="user-post-form">
        <h3>Viết bài mới</h3>
        <input type="text" name="user_post_title" placeholder="Tiêu đề" required>
        <textarea name="user_post_content" placeholder="Nội dung" required rows="6"></textarea>
        <label>Ảnh bìa (tùy chọn):</label>
        <input type="file" name="user_post_thumbnail" accept="image/*">
        <input type="submit" name="user_post_submit" value="Gửi bài">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('user_post_form', 'user_post_frontend_form');

// Xử lý gửi bài và upload ảnh bìa
function handle_user_post_submission() {
    if (
        isset($_POST['user_post_submit']) &&
        !empty($_POST['user_post_title']) &&
        !empty($_POST['user_post_content']) &&
        is_user_logged_in()
    ) {
        $post_data = array(
            'post_title'    => sanitize_text_field($_POST['user_post_title']),
            'post_content'  => wp_kses_post($_POST['user_post_content']),
            'post_status'   => 'pending', // Chờ admin duyệt
            'post_author'   => get_current_user_id(),
            'post_type'     => 'user_post'
        );
        $post_id = wp_insert_post($post_data);

        // Xử lý upload ảnh bìa
        if ($post_id && !empty($_FILES['user_post_thumbnail']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $file = $_FILES['user_post_thumbnail'];
            $upload = wp_handle_upload($file, array('test_form' => false));
            if (!isset($upload['error']) && isset($upload['file'])) {
                $filetype = wp_check_filetype($upload['file'], null);
                $attachment = array(
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => sanitize_file_name($file['name']),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                set_post_thumbnail($post_id, $attach_id);
            }
        }
    }
}
add_action('wp', 'handle_user_post_submission');

// Trang quản lý bài viết (shortcode: [user_post_manager])
function user_post_manager_shortcode() {
    if (!is_user_logged_in()) {
        return '<p>Bạn cần <a href="' . wp_login_url() . '">đăng nhập</a> để xem bài viết của mình.</p>';
    }
    ob_start();
    echo '<div class="user-post-list">';
    $args = array(
        'post_type' => 'user_post',
        'author'    => get_current_user_id(),
        'post_status' => array('publish', 'pending', 'draft'),
        'posts_per_page' => 20
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        echo '<h3>Bài viết của bạn</h3><ul>';
        while ($query->have_posts()) {
            $query->the_post();
            $edit_link = site_url('/sua-bai/?post_id=' . get_the_ID());
            echo '<li>
                    <a href="' . get_permalink() . '">' . get_the_title() . '</a> (' . get_post_status() . ')
                    <a href="' . esc_url($edit_link) . '" class="edit-post-btn" style="margin-left:12px;color:#007bff;text-decoration:underline;font-size:0.95em;">Chỉnh sửa</a>
                  </li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<p>Bạn chưa có bài viết nào.</p>';
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('user_post_manager', 'user_post_manager_shortcode');

// Trang chỉnh sửa bài ngoài frontend (shortcode: [user_post_edit])
function user_post_edit_shortcode() {
    if (!is_user_logged_in() || empty($_GET['post_id'])) {
        return '<p>Bạn không có quyền truy cập.</p>';
    }
    $post_id = intval($_GET['post_id']);
    $post = get_post($post_id);
    if (!$post || $post->post_author != get_current_user_id() || $post->post_type != 'user_post') {
        return '<p>Bạn không có quyền chỉnh sửa bài này.</p>';
    }

    if (isset($_POST['user_post_update'])) {
        $title = sanitize_text_field($_POST['user_post_title']);
        $content = wp_kses_post($_POST['user_post_content']);
        wp_update_post([
            'ID' => $post_id,
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'pending'
        ]);
        return '<p>Đã cập nhật bài viết! Chờ admin duyệt lại.</p>';
    }

    ob_start();
    ?>
    <form method="post" class="user-post-form">
        <h3>Chỉnh sửa bài viết</h3>
        <input type="text" name="user_post_title" value="<?php echo esc_attr($post->post_title); ?>" required>
        <textarea name="user_post_content" rows="6" required><?php echo esc_textarea($post->post_content); ?></textarea>
        <input type="submit" name="user_post_update" value="Cập nhật">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('user_post_edit', 'user_post_edit_shortcode');