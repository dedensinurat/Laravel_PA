// Untuk dropdown dengan class "dropdown"
document.querySelectorAll('.dropdown').forEach(item => {
    item.addEventListener('mouseover', event => {
        item.querySelector('.dropdown-menu').style.display = 'block';
    });

    item.addEventListener('mouseout', event => {
        item.querySelector('.dropdown-menu').style.display = 'none';
    });
});
