document.addEventListener('DOMContentLoaded', function() {
    const produk = document.getElementById('produk');
    const id_produk = document.getElementById('id_produk');

    dropdown.addEventListener('change', function() {
        id_produk.value = produk.value;
    });
});
