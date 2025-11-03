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
        <h2>Thương hiệu LSOUL bất ngờ đổi tên từ LSEOUL</h2>
        <p>By admin • 6 December, 2024</p>
        <img
          src="https://bazaarvietnam.vn/wp-content/uploads/2024/10/bazaarvietnam-lsoul-bitis-khong-ngai-thay-ao-moi-mua-cuoi-nam1.jpg"
          alt="Bài viết 3">
        <p>Thay vì đóng cửa như những tin đồn gần đây, thương hiệu thời trang LSOUL (trước đó là LSEOUL) đã gây bất ngờ
          khi công bố quyết định tái định vị với một tên gọi hoàn toàn mới. Quyết định này không chỉ thu hút sự chú ý
          của cộng đồng mạng mà còn làm dậy sóng giới mộ điệu thời trang trên toàn cầu, đặc biệt là những người yêu mến
          thương hiệu.</p>

        <p>LSEOUL từng khẳng định vị thế của mình với những bộ sưu tập tinh tế và phong cách tối giản đầy thẩm mỹ. Tuy
          nhiên, trước sự thay đổi không ngừng của thị trường thời trang và nhu cầu ngày càng cao của khách hàng, thương
          hiệu đã quyết định chuyển mình thành LSOUL, nhằm đáp ứng xu hướng mới và xây dựng chiến lược phát triển dài
          hạn.</p>

        <p>Sự thay đổi không chỉ dừng lại ở cái tên, mà còn là bước tiến táo bạo trong cách tiếp cận khách hàng và mở
          rộng thị trường quốc tế. Đại diện LSOUL chia sẻ: “Dưới tên LSEOUL, chúng tôi đã đạt được những cột mốc đáng kể
          cả ở Việt Nam và quốc tế. 6 năm qua là một hành trình đầy thử thách để khẳng định bản sắc của riêng mình,
          nhưng những thành quả đạt được thật rực rỡ nhờ vào sự cống hiến của từng cá nhân và sự ủng hộ, yêu thương
          không ngừng từ các bạn, những người hâm mộ của chúng tôi.</p>

        <p>Và hôm nay, một chương khép lại để mở ra một chương mới. Chúng tôi đã quyết định đổi tên từ LSEOUL thành
          LSOUL, để nhấn mạnh vào tâm hồn của mỗi thiết kế, đồng thời tránh những hiểu lầm có thể xảy ra khi chúng tôi
          đưa thời trang Việt Nam ra thị trường quốc tế”.</p>

        <p>Ngay sau khi thông báo đổi tên, LSOUL lập tức thông báo sẽ khai trương cửa hàng flagship đầu tiên ở Emsphere
          Mall, Thái Lan vào tháng 12. Sự kiện quan trọng này đánh dấu giai đoạn vươn ra toàn cầu của thương hiệu. Bước
          ngoặt này đánh dấu một chương mới đầy thú vị trong hành trình của LSOUL. Sự thay đổi không phải là từ bỏ giá
          trị cốt lõi mà là sự phát triển mạnh mẽ hơn, phù hợp với thời đại. LSOUL tiếp tục kể câu chuyện thời trang của
          mình, truyền tải thông điệp sâu sắc qua từng thiết kế, giúp khách hàng không chỉ mặc đồ mà còn cảm nhận được
          câu chuyện đằng sau mỗi sản phẩm và quốc gia mà nó đang hiện hữu.</p>
        <img
          src="https://bazaarvietnam.vn/wp-content/uploads/2024/10/bazaarvietnam-lsoul-bitis-khong-ngai-thay-ao-moi-mua-cuoi-nam2.jpg"
          alt="Bài viết 3">
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