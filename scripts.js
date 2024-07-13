document.getElementById('search-button').addEventListener('click', function() {
    const query = document.getElementById('search-input').value;
    db.collection('products').where('name', '>=', query).get().then((querySnapshot) => {
        const results = document.getElementById('search-results');
        results.innerHTML = '';
        querySnapshot.forEach((doc) => {
            const product = doc.data();
            const productDiv = document.createElement('div');
            productDiv.classList.add('product');
            productDiv.innerHTML = `
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <p>Sustainability Rating: ${product.sustainability_rating}</p>
            `;
            results.appendChild(productDiv);
        });
    });
});
