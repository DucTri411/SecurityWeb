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
        <h2>CEO Nguyễn Trọng Lâm đưa thương hiệu Việt LSEOUL bước ra thế giới</h2>
        <p>By admin • 6 December, 2024</p>
        <img src="https://bazaarvietnam.vn/wp-content/uploads/2024/06/BZ-Nguyen-Trong-Lam-LSEOUL2.jpg"
          alt="CEO Nguyễn Trọng Lâm đưa thương hiệu Việt LSEOUL bước ra thế giới">
        <p>Nguyễn Trọng Lâm, Nhà sáng lập và CEO của thương hiệu LSEOUL, đã ghi dấu ấn mạnh mẽ trong ngành thời trang
          quốc
          tế với chiến dịch Black Women đầy ấn tượng. Chiến dịch đã thu hút sự chú ý của các ngôi sao quốc tế và truyền
          thông toàn cầu.</p>

        <p>Với sự phát triển vượt bậc, LSEOUL giờ đây không chỉ được các ngôi sao nổi tiếng như Jennie (Blackpink), IU
          yêu
          thích mà còn mở rộng tầm ảnh hưởng ra các thị trường quốc tế. Sự kiện tổ chức show diễn Incomparable và khai
          trương cửa hàng độc lập tại Bangkok là minh chứng cho sự thành công của LSEOUL.</p>

        <p>Chính sự sáng tạo và quyết tâm của Nguyễn Trọng Lâm đã giúp LSEOUL trở thành thương hiệu mang đậm dấu ấn Việt
          Nam và vươn tầm thế giới, chứng minh rằng thương hiệu Việt hoàn toàn có thể tỏa sáng trên trường quốc tế.</p>

        <p>Sự xuất hiện của LSEOUL tại các tuần lễ thời trang quốc tế như New York và London sẽ tiếp tục khẳng định sức
          mạnh và vị thế của thương hiệu Việt trên bản đồ thời trang thế giới.</p>
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