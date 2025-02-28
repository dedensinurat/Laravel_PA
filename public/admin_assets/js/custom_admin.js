function fillEditForm(id_jam, jam, jamMulai, jamSelesai, hari) {
    // Isi nilai input pada form edit dengan data yang ingin diedit
    document.getElementById('edit_id').value = id_jam;
    document.getElementById('edit_jam').value = jam;
    document.getElementById('edit_jam_mulai').value = jamMulai;
    document.getElementById('edit_jam_selesai').value = jamSelesai;

    // Set nilai input dan label untuk hari
    document.getElementById('edit_hari').value = hari;
    document.getElementById('hariLabel').innerText = hari;
}


// Ambil URL saat ini
var currentUrl = "{{ Request::url() }}";

// Ambil semua link di navbar
var navLinks = document.querySelectorAll('.nav-link-cus');

// Periksa setiap link
navLinks.forEach(function (link) {
    // Jika URL link sama dengan URL saat ini
    if (link.href === currentUrl) {
        // Tambahkan kelas active
        link.classList.add('active');
    }
});
