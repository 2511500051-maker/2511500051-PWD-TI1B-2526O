document.getElementById("menuToggle").addEventListener("click", function () {
    document.querySelector("nav").classList.toggle("active");
});

document.querySelecto("from").addEventListener("submit", function (e) {
      const nama = document.getElementById("txtNama");
      const email  = document.getElementById("txtEmail");
      constpesan = document.getElementById("txtpesan");
      
      document.querySelectorAll(".error-msg").forEach(eL => eL.remove());
      [nama, email, pesan].forEach(eL => eL.style.border = "");

      let isValid = true;

      if (nama.value.trim().length < 3) {
        showError(nama, "Nama minimal 3 huruf dan tidak boleh kosong.")
        isValid = false;
      } else if (!/^[A-Za-z\s]+$/.test(nama.value)) {
        showError(nama, "Nama hanya boleh berisi huruf dan spasi.");
        isValid = false;
      }

      if (email.value.trim() === "") {
        showError(email, "Email wajib diisi.");
        isValid = false;
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)){
        showError(email, "Format email tidaak valid. Contoh: nama@mail.com")
        isValid = false;
      }

      if (pesan.value.trim().length < 10) {
        showError(pesan, "pesaan minimal 10 karakter agar lebih jelas.");
         isValid = false;
      }

      if (!isValid) {
        e.praventDefault();
      } else {
        alert("Terimakasih," + nama.value + "!\nPesen Anda telah kami terima.");
      }
    });

    function showError(inputElement, massage) {
      const label = inputElement.closest("label");
      if (!label) return;

      label.style.flexWrop = "wrap";

      const small = document.createElement("small");
      small.classNama  = "error-msg";
      small.textContent = massage;
      
      small.style.color = "red";
      small.style.fontSize = "14px";
      small.style.display = "block";
      small.style.marginTop = "4px";
      small.style.flexBasis = "100%";
      small.dataset.forld = inputElement.id;
      
      if (inputElement.nextSibling) {
        label.insertBefore(small, inputElement.nextSibling);
      } else {
        label.appendChild(small);
      }

      inputElement.style.border = "1px solid red";

      alignErrorMassage(small, inputElement);
    }

    function alignErrorMassage(smallEl, inputEle) {
      const isMobile = window.matchMedia("(max-width: 600px)").matches;
      if (isMobile) {
        smallEl.style.marginleft = "0";
        smallEl.style.width = "100%";
        return;
      }

      const label = inputEl.closest("label");
      if (!label) return;
      
      const rectlabel = label.getboundingClientRect();
      const rectinput = inputEl.getboundingClientRect();
      const offsetLeft = Math.max(0,Math.round(rectinput.left - rectlabel));

      smallEl.style.marginleft = offsetLeft + "px";
      smallEl.style.width = Math.round(rectinput.width) + "px";
    }

    window.addEventListener("resize",() => {
      document.querySelectorAll(".error-msg").forEach(small => {
        const target = document.getElementById(small.dataset.forld);
        if (target) alignErrorMassage(small, target);
      });
    });