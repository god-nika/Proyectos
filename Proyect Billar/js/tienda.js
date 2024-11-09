// Datos de ejemplo para los productos
const productos = [
    { nombre: "Pilsner Urquell", descripcion: "Descripción del producto 1", precio: 20.00, imagen: "../img/pilsner-urquell.jpg" },
    { nombre: "Aguila", descripcion: "Descripción del producto 2", precio: 30.00, imagen: "../img/Aguila.jfif" },
    { nombre: "corona", descripcion: "Descripción del producto 3", precio: 25.00, imagen: "../img/corona.jfif" },
    { nombre: "Producto 4", descripcion: "Descripción del producto 4", precio: 35.00, imagen: "../img/zoro.webp" },
    { nombre: "Producto 5", descripcion: "Descripción del producto 5", precio: 24.00, imagen: "../img/kafka.jpg" },
    { nombre: "Producto 6", descripcion: "Descripción del producto 6", precio: 19.00, imagen: "../img/kotaro.jfif" },
];

// Función para mostrar los productos en la página
function mostrarProductos() {
    const productosSection = document.getElementById("productos");

    productos.forEach(producto => {
        const productoDiv = document.createElement("div");
        productoDiv.classList.add("producto");
        productoDiv.innerHTML = `
            <img src="${producto.imagen}" alt="${producto.nombre}">
            <h2>${producto.nombre}</h2>
            <p>${producto.descripcion}</p>
            <p>Precio: $${producto.precio.toFixed(2)}</p>
            <button class="agregar-carrito">Agregar al Carrito</button>
        `;
        productosSection.appendChild(productoDiv);
    });
}

// Llamar a la función para mostrar los productos cuando se cargue la página
document.addEventListener("DOMContentLoaded", mostrarProductos);


