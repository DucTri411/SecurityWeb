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
        <h2>L Seoul, local brand Việt lọt mắt xanh các nghệ sỹ "quốc tế"</h2>
        <p>By admin • 6 December, 2024</p>

        <img src="https://bazaarvietnam.vn/wp-content/uploads/2024/04/Jennie-BLACKPINK-dien-local-brand-Viet-03.jpg"
          alt="L Seoul local brand Việt">
        <p>L Seoul, thương hiệu local brand Việt, đã gây được sự chú ý không chỉ trong nước mà còn ở thị trường quốc tế.
          Được thành lập vào năm 2016, L Seoul nổi bật với phong cách trẻ trung, nữ tính và gợi cảm, mang đến những sản
          phẩm thời trang hợp trend, như Y2K, balletcore hay coquettecore, thu hút đông đảo tín đồ thời trang trẻ. </p>

        <p>Thương hiệu này không chỉ được yêu thích bởi các nghệ sỹ trong nước như Hoa hậu Thùy Tiên, Tóc Tiên, và Thảo
          Nhi Lê, mà còn khiến nhiều ngôi sao quốc tế "mê mẩn". L Seoul đã vươn ra khỏi biên giới Việt Nam, lọt vào mắt
          xanh của các nghệ sỹ quốc tế, đặc biệt là từ Thái Lan và Hàn Quốc. Các tín đồ thời trang tại Thái Lan gần đây
          đã
          đổ xô đến Việt Nam để săn lùng các thiết kế của L Seoul.</p>

        <img src="https://bazaarvietnam.vn/wp-content/uploads/2024/04/Jennie-BLACKPINK-dien-local-brand-Viet-02.jpg"
          alt="Jennie mặc trang phục L Seoul">
        <p>Sau Thái Lan, L Seoul hiện cũng đang được chú ý tại Hàn Quốc, nơi nhiều ngôi sao K-pop như Jennie
          (BLACKPINK),
          Miyeon (G)I-DLE, IU và TWICE đã chọn lựa trang phục từ thương hiệu này cho các sự kiện lớn. Dara, cựu thành
          viên
          của 2NE1, cũng đã mặc trang phục L Seoul trong buổi biểu diễn tại Seoul Music Awards 2024, làm dấy lên cơn sốt
          trong cộng đồng yêu thời trang.</p>

        <p>Sự xuất hiện của các ngôi sao quốc tế trong các thiết kế của L Seoul không chỉ khẳng định được vị thế của
          thương hiệu tại các thị trường lớn mà còn giúp mở rộng ảnh hưởng của thời trang Việt ra thế giới, đồng thời
          mang
          lại niềm tự hào cho cộng đồng thời trang Việt Nam.</p>
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