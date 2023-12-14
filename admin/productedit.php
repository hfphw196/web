<?php
include "header.php";
include "slider.php";
include "class/product_class.php";

$product = new product;
$product_id = $_GET['product_id'];
$get_product = $product->get_product($product_id);

if ($get_product) {
    $resultP = $get_product->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = $_POST["product_name"];
    $cartegory_id = $_POST["cartegory_id"];
    $brand_id = $_POST["brand_id"];
    $product_price = $_POST["product_price"];
    $product_price_new = $_POST["product_price_new"];
    $product_desc = $_POST["product_desc"];
    $product_img = $_FILES["product_img"]["name"];
    move_uploaded_file($_FILES["product_img"]["tmp_name"], "uploads/" . $_FILES["product_img"]["name"]);

    // Xử lý ảnh mô tả mới
    $new_product_imgs_desc = [];
    if (!empty($_FILES["product_img_desc"]["name"])) {
        $new_product_img_desc = $_FILES["product_img_desc"]["name"];
        $new_product_img_tmp_desc = $_FILES["product_img_desc"]["tmp_name"];

        foreach ($new_product_img_desc as $key => $value) {
            move_uploaded_file($new_product_img_tmp_desc[$key], 'uploads/' . $value);
            $new_product_imgs_desc[] = $value;
        }
    }

    // Cập nhật thông tin sản phẩm
    $update_product = $product->update_product($product_name, $product_price, $product_price_new, $product_desc, $product_img, $brand_id, $cartegory_id, $product_id, $product_img_desc);
}
?>

<style>
    input, select, textarea {
        height: 30px;
        width: 200px;
        margin-bottom: 10px;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Các trường thông tin tương tự như trang productadd.php -->
            <label for="">Nhập tên sản phẩm<span style="color: red;">*</span></label>
            <input name="product_name" require type="text" value="<?php echo $resultP['product_name']; ?>">

            <label for="">Chọn danh mục<span style="color: red;">*</span></label>
            <select name="cartegory_id" id="cartegory_id">
                <option value="#">--Chọn--</option>
                <?php
                $show_cartegory = $product->show_cartegory();
                if ($show_cartegory) {
                    while ($result = $show_cartegory->fetch_assoc()) {
                        $selected = ($resultP['cartegory_id'] == $result['cartegory_id']) ? 'selected' : '';
                ?>
                        <option value="<?php echo $result['cartegory_id'] ?>" <?php echo $selected; ?>><?php echo $result['cartegory_name'] ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label for="">Chọn loại sản phẩm<span style="color: red;">*</span></label>
            <select name="brand_id" id="brand_id">
                <option value="#">--Chọn--</option>
                <?php
                $show_brand = $product->show_brand();
                if ($show_brand) {
                    while ($result = $show_brand->fetch_assoc()) {
                        $selected = ($resultP['brand_id'] == $result['brand_id']) ? 'selected' : '';
                ?>
                        <option value="<?php echo $result['brand_id'] ?>" <?php echo $selected; ?>><?php echo $result['brand_name'] ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
            <input name="product_price" require type="text" value="<?php echo $resultP['product_price']; ?>">

            <label for="">Giá khuyến mãi<span style="color: red;">*</span></label>
            <input name="product_price_new" require type="text" value="<?php echo $resultP['product_price_new']; ?>">

            <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
            <textarea required name="product_desc" id="editor1" cols="30" rows="10"><?php echo $resultP['product_desc']; ?></textarea>

            <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
            <input name="product_img" require type="file">
            <!-- Hiển thị hình ảnh cũ -->
            <img src="<?php echo $resultP['product_img']; ?>" alt="" style="width: 50px; height: 50px;">

            <label for="">Ảnh mô tả<span style="color: red;">*</span></label>
            <input name="product_img_desc[]" require multiple type="file">
            <!-- Hiển thị hình ảnh mô tả cũ của sản phẩm -->
            <?php
            if (!empty($old_product_imgs_desc)) {
                foreach ($old_product_imgs_desc as $img_desc) {
            ?>
                    <img src="uploads/<?php echo $img_desc; ?>" alt="" style="width: 50px; height: 50px;">
            <?php
                }
            }
            ?>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>

</body>
</html>
