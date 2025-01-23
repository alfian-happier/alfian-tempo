// menampilkan foto about dan benefit pada saat pengguna mau menggantinya
function previewImage() {
  const file = document.getElementById('foto').files[0];
  const preview = document.getElementById('fotoPreview');

  if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
          preview.src = e.target.result;
      }

      reader.readAsDataURL(file);
  }
}

// menampilkan foto team di create
function previewImage() {
  const file = document.getElementById('uploadFoto').files[0];
  const preview = document.getElementById('previewFoto');
  const reader = new FileReader();

  reader.onloadend = function() {
      preview.src = reader.result;
      preview.style.display = 'block';
  }

  if (file) {
      reader.readAsDataURL(file);
  } else {
      preview.src = "";
      preview.style.display = 'none';
  }
}

// menampilkan foto create pengguna
function previewImage() {
  const file = document.getElementById("uploadFoto").files[0];
  const preview = document.getElementById("previewFoto");
  
  const reader = new FileReader();
  
  reader.addEventListener("load", function () {
      preview.src = reader.result;
      preview.style.display = "block";
  }, false);
  
  if (file) {
      reader.readAsDataURL(file);
  }
}

// menampilkan foto pengguna ketika di edit
function previewImage() {
  const file = document.getElementById('foto').files[0];
  const preview = document.getElementById('fotoPreview');

  if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
          preview.src = e.target.result;
      }

      reader.readAsDataURL(file);
  }
}
