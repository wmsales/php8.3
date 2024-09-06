CREATE DATABASE IF NOT EXISTS data_erp_db;
USE data_erp_db;

CREATE TABLE IF NOT EXISTS cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS credito_cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    credito_total DECIMAL(10, 2) NOT NULL, -- Total del crédito permitido
    credito_utilizado DECIMAL(10, 2) NOT NULL DEFAULT 0, -- Crédito utilizado
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id)
);

CREATE TABLE IF NOT EXISTS producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    costo DECIMAL(10, 2) NOT NULL,
    precio_publico DECIMAL(10, 2) NOT NULL,
    precio_mayorista DECIMAL(10, 2),
	precio_super_mayorista DECIMAL(10, 2),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS estado_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ejemplos: 'Pendiente', 'Aceptado', 'Completado', 'Cancelado'
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    estado_id INT NOT NULL, -- Relación con estados de pedido
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (estado_id) REFERENCES estado_pedido(id)
);

CREATE TABLE IF NOT EXISTS pedido_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (pedido_id) REFERENCES pedido(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE IF NOT EXISTS factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha_factura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    pedido_id INT, -- Factura puede o no tener un pedido asociado
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (pedido_id) REFERENCES pedido(id) -- Si la factura está asociada a un pedido
);

CREATE TABLE IF NOT EXISTS factura_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (factura_id) REFERENCES factura(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE IF NOT EXISTS compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proveedor VARCHAR(255) NOT NULL,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS compra_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (compra_id) REFERENCES compra(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE IF NOT EXISTS resumen_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_resumen DATE NOT NULL, -- Fecha del resumen (generalmente fin de mes)
    total_ventas DECIMAL(10, 2) NOT NULL,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS resumen_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_resumen DATE NOT NULL, -- Fecha del resumen (generalmente fin de mes)
    total_compras DECIMAL(10, 2) NOT NULL,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS metodo_pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT NOT NULL, -- Pago relacionado a una factura (venta)
    metodo_pago_id INT NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (factura_id) REFERENCES factura(id),
    FOREIGN KEY (metodo_pago_id) REFERENCES metodo_pago(id)
);

CREATE TABLE IF NOT EXISTS tipo_movimiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ejemplos: 'Ingreso', 'Egreso'
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS movimiento_caja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_movimiento_id INT NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    descripcion TEXT,
    fecha_movimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (tipo_movimiento_id) REFERENCES tipo_movimiento(id)
);

CREATE TABLE IF NOT EXISTS configuracion_empresa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_empresa VARCHAR(255) NOT NULL,
    direccion TEXT NOT NULL,
    telefono VARCHAR(50),
    email_contacto VARCHAR(255),
    website VARCHAR(255),
    logo_empresa VARCHAR(255),
    nit VARCHAR(50),
    razon_social VARCHAR(255),
    lema_empresa VARCHAR(255),
    politica_credito TEXT,
    limite_credito_global DECIMAL(10, 2) DEFAULT 0,
    dias_max_credito INT DEFAULT 30,
    tasa_interes_credito DECIMAL(5, 2) DEFAULT 0,
    moneda_oficial VARCHAR(50) DEFAULT 'GTQ',
    horario_atencion VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

-- Estados de Pedido
INSERT INTO estado_pedido (nombre) VALUES ('Pendiente'), ('Aceptado'), ('Completado'), ('Cancelado');

-- Métodos de Pago
INSERT INTO metodo_pago (nombre) VALUES ('Efectivo'), ('Tarjeta'), ('Transferencia'), ('Crédito');

-- Tipos de Movimiento Financiero
INSERT INTO tipo_movimiento (nombre) VALUES ('Ingreso'), ('Egreso');
