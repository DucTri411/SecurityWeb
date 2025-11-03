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
        <h2>Một lần được Jennie diện, chiếc váy của L SOUL "sold out" hoàn toàn</h2>
        <p>By admin • 4 December, 2024</p>

        <p>Dành cho những ai đang "tiếc hùi hụi" vì hụt mất khoảnh khắc được cheap moment với idol, L SOUL vẫn tiếp tục
          nhận pre-order chiếc váy hot nhất những ngày qua...</p>

        <p>Đây không phải là lần đầu tiên thương hiệu này được các ngôi sao K-pop diện đồ, và tất nhiên, lại càng không
          phải là lần hiếm hoi một thương hiệu Việt xuất hiện trên bản đồ thời trang thế giới. Trong hơn một năm qua,
          thiết kế Việt đã nhiều lần được "cả thế giới" săn lùng nhờ vào sự yêu thích của các idol K-pop, và dàn celeb
          nổi
          tiếng toàn cầu cũng ưa chuộng. Mức giá phải chăng và thiết kế ấn tượng của L SOUL đang tạo nên làn sóng mạnh
          mẽ
          không chỉ ở Việt Nam mà còn trên toàn thế giới.</p>

        <p>Vào thời điểm này, khi trước đây, các tín đồ thời trang Việt luôn tìm kiếm đồ nội địa từ các thương hiệu
          Trung
          Quốc, Hàn Quốc hay Thái Lan, thì giờ đây, chính các sản phẩm thời trang Việt đang thu hút sự chú ý của cả khu
          vực Đông Nam Á và quốc tế. Chất lượng và sự sáng tạo trong thiết kế của L SOUL chính là yếu tố đã giúp thương
          hiệu tạo dựng được chỗ đứng vững chắc trên thị trường quốc tế.</p>

        <p>Quay lại với câu chuyện của L SOUL, gần đây, Jennie đã đăng tải một video quảng cáo bộ sưu tập kính mắt kết
          hợp
          cùng Gentle Monster trên Instagram. Không mất quá lâu, người hâm mộ đã nhận ra chiếc váy mà Jennie diện thuộc
          bộ
          sưu tập Calos của L SOUL, được bán với giá 980.000 đồng. Và kết quả là, hơn 2000 chiếc váy trong kho đã được
          bán
          hết trong vòng 15 phút. Điều này cho thấy sức hút mạnh mẽ của L SOUL trên thị trường quốc tế.</p>
        <img
          src="https://www.lofficielvietnam.com/_next/image?url=https%3A%2F%2Fwww.datocms-assets.com%2F56778%2F1713838670-thumb-web-lo-14.jpg%3Fauto%3Dformat%252Ccompress%26cs%3Dsrgb&w=3840&q=75"
          alt="Bài viết 2">
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