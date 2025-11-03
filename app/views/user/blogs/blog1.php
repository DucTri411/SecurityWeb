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
        <h2>Thương hiệu thời trang nữ L Soul “đốn tim” mọi cô nàng</h2>
        <p>By admin • 5 December, 2024</p>
        <img src="https://channel.mediacdn.vn/428462621602512896/2023/6/2/photo-1-16856954932251633378377.jpg"
          alt="Bài viết 1">
        <p>Từ một cửa hàng thời trang nhỏ trong hẻm, L Soul đã vươn lên thành thương hiệu được yêu thích trong giới trẻ
          những năm gần đây. Để đánh dấu sự trưởng thành sau thời gian "ẩn mình", thương hiệu đã tổ chức sự kiện Nightly
          Night như một dịp tái mở cửa gần đây. Đối với những tín đồ yêu thích các bộ váy ngọt ngào, cá tính và luôn đón
          đầu xu hướng, L Soul chắc chắn là cái tên không thể bỏ qua.</p>
        <p>Được "spotlight" tại sự kiện lần này là hai bộ sưu tập mới ra mắt: "A Line Of Beauty" và "A Muse's Garden",
          khiến giới mộ điệu không khỏi mãn nhãn. Màn trở lại đầy tươi mới của thương hiệu cùng sự hoàn hảo của các bộ
          sưu
          tập khiến đối tác và khách hàng có mặt tại sự kiện đều ngỡ ngàng.</p>

        <p>Lấy cảm hứng từ những điều giản dị nhưng đầy mới mẻ, bộ sưu tập "A Line Of Beauty" mang đến sự tự do, thoải
          mái
          nhưng vẫn tôn vinh được những đường cong mềm mại của người con gái. Dưới ánh đèn lung linh của đêm sự kiện,
          các
          gam màu được nhà thiết kế chọn lựa tỉ mỉ cho mỗi chiếc váy trở nên thật đặc biệt và thu hút mọi ánh nhìn.
          Những
          chiếc váy màu be hay hồng pastel mang lại làn gió mát mẻ cho mùa hè, trong khi những chiếc váy màu trắng ivory
          hay đen ẩn chứa vẻ đẹp đơn giản mà quyến rũ, sang trọng. Tất cả đã tạo nên "A Line Of Beauty" — bộ sưu tập
          dành
          cho những ai yêu thích sự sống động và ngọt ngào trong từng thiết kế.</p>

        <p>Một điểm đặc biệt trong bộ sưu tập này là các chiếc nơ handmade được đính kết tỉ mỉ cùng với các đường cắt
          may
          tinh xảo, tạo nên xu hướng "hot" trong năm 2023. Có thể nói, khi diện những thiết kế này, bạn sẽ trở thành tâm
          điểm của đám đông, thu hút mọi ánh nhìn.</p>

        <p>Trái ngược với "A Line Of Beauty", "A Muse's Garden" sử dụng chất liệu denim mang đến một phong cách cá tính
          và
          thời thượng. Mặc dù lấy cảm hứng từ phong cách lãng mạn của những năm 90, bộ sưu tập này lại kết hợp hoàn hảo
          giữa nét cổ điển và hiện đại, mang đến một thời trang vừa đậm chất retro lại không hề lỗi mốt. Nhà thiết kế
          cũng
          muốn "thổi" vào bộ sưu tập này một làn gió mới: "nữ tính nhưng đầy cá tính".</p>

        <p>L Soul đã chính thức trở lại và tiếp tục chiều lòng các tín đồ yêu thích những chiếc váy ngọt ngào. Trong
          tương
          lai, thương hiệu sẽ mang đến những mẫu thời trang đa dạng, trendy và phù hợp với các chị em. Hiện thương hiệu
          có
          mặt tại 257B Nguyễn Trãi, Quận 1, TP.HCM.</p>

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