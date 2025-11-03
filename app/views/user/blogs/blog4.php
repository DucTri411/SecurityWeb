<style>
  .blog-container {
    border: 1px solid #e0e0e0;
    /* Đường viền xung quanh card */
    border-radius: 8px;
    /* Bo góc card */
    overflow: hidden;
    /* Cắt nội dung tràn */
    background-color: #ffffffa9;
    /* Nền trắng */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    /* Bóng mờ tạo độ nổi */
  }

  .blog-container img {
    width: 50%;
    max-width: 800px;
    /* Giới hạn chiều rộng ảnh */
    display: block;
    margin: 20px auto;
    /* Căn giữa ảnh */
  }

  p {
    margin: 20px 0;
    text-align: justify;
    padding: 0 25px;
    /* Thêm lề trái phải cho đoạn văn */
  }

  article {
    margin-top: 100px;
  }
</style>

<div class="blog-content-container">
  <div class="blog-container">
    <main>
      <article>
        <h2>Cơ hội cheap moment cùng Jennie với chân váy local brand Việt</h2>
        <p>By admin • 6 December, 2024</p>
        <img
          src="https://bazaarvietnam.vn/wp-content/uploads/2024/02/jennie-blackpink-bayonetta-glasses-jentle-gentle-monster.jpg"
          alt="Jennie với chân váy local brand Việt">
        <p>Được mệnh danh là It girl của làng giải trí xứ Hàn, không quá khó hiểu khi bất kỳ outfit nào của Jennie cũng
          được bàn tán. Tuy nhiên, dù là đại sứ của những thương hiệu cao cấp và cũng có khả năng tậu hàng hiệu, nhưng
          nữ
          thần tượng không chỉ lăng-xê các thương hiệu xa xỉ. Thay vào đó, Jennie thường xuyên mặc các item bình dị, dễ
          dàng được tiếp cận bởi các tín đồ thời trang.</p>

        <p>Sau nhiều lần lăng-xê trang phục từ các thương hiệu local brand từ quê nhà Hàn Quốc, mới đây Jennie đã quyết
          định mang đến “làn gió mới” cho tủ quần áo của mình bằng một thiết kế đến từ Việt Nam. Với chiếc chân váy xinh
          xắn từ thương hiệu local brand Việt, Jennie đã mang đến một làn sóng mới trong giới thời trang quốc tế.</p>

        <p>Trang phục này không chỉ mang đến vẻ ngoài thanh lịch, trẻ trung mà còn thể hiện được sự tinh tế trong việc
          kết
          hợp giữa phong cách thời trang quốc tế và những thiết kế độc đáo của các thương hiệu nội địa. Jennie đã chứng
          tỏ
          rằng những món đồ local brand không hề thua kém các sản phẩm cao cấp mà cô vẫn yêu thích.</p>

        <p>Sự kết hợp này một lần nữa làm nổi bật khả năng gây ảnh hưởng mạnh mẽ của Jennie trong ngành thời trang, đặc
          biệt là trong việc đưa những thương hiệu Việt đến gần hơn với cộng đồng quốc tế.</p>
      </article>
    </main>
  </div>
</div>


<script>
  const menuIcon = document.getElementById("menu-icon");
  const mobileMenu = document.getElementById("mobile-menu");
  const closeBtn = document.getElementById("close-btn");

  // Khi nhấn vào biểu tượng menu
  menuIcon.addEventListener("click", () => {
    mobileMenu.classList.add("open"); // Thêm class "open" để mở menu
  });

  // Khi nhấn vào nút đóng menu
  closeBtn.addEventListener("click", () => {
    mobileMenu.classList.remove("open"); // Loại bỏ class "open" để đóng menu
  });

  // Đóng menu khi nhấn vào bất kỳ link nào trong menu
  const navLinks = mobileMenu.querySelectorAll("a");
  navLinks.forEach(link => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("open");
    });
  });
</script>