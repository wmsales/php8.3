CREATE DATABASE IF NOT EXISTS data_erp_db;
USE data_erp_db;

CREATE TABLE IF NOT EXISTS cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(255),
    nit VARCHAR(50) NOT NULL DEFAULT 'CF',
    cui VARCHAR(200),
    fecha_nacimiento DATE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (rol_id) REFERENCES rol(id)
);

CREATE TABLE IF NOT EXISTS estado_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ejemplos: 'Pendiente', 'Aceptado', 'Completado', 'Cancelado'
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

CREATE TABLE IF NOT EXISTS almacen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ubicacion VARCHAR(255),
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(50) UNIQUE, -- Código único de producto
    codigo_barras VARCHAR(100), -- Código de barras del producto
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    costo DECIMAL(10, 2) NOT NULL,
    precio_publico DECIMAL(10, 2) NOT NULL,
    precio_mayorista DECIMAL(10, 2),
	precio_super_mayorista DECIMAL(10, 2),
    stock_minimo INT DEFAULT 0, -- Stock mínimo aceptado antes de generar alertas
    stock_maximo INT DEFAULT 1000, -- Stock máximo permitido en bodega
    inventario_negativo BOOLEAN DEFAULT FALSE, -- Permitir inventario negativo
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL, -- Cantidad actual en stock
    ubicacion VARCHAR(255), -- Ubicación del producto en la bodega
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE IF NOT EXISTS tipos_movimiento_inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Nombre del tipo de movimiento, ej: 'Entrada', 'Salida'
    descripcion TEXT, -- Descripción del tipo de movimiento
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
    uuid VARCHAR(100) NOT NULL UNIQUE,
    numero_serie VARCHAR(50) NOT NULL, -- Serie de la factura asignada por la SAT
    numero_factura VARCHAR(50) NOT NULL, -- Número de factura correlativo asignado por la SAT
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
    telefono VARCHAR(20) NOT NULL,
    telefono_secundario VARCHAR(20) NULL,
    email_contacto VARCHAR(255),
    website VARCHAR(255),
    logo_empresa VARCHAR(255),
    nit VARCHAR(50),
    razon_social VARCHAR(255),
    lema_empresa VARCHAR(255),
    politica_credito JSON, -- Para una configuración de política de crédito completa
    limite_credito_global DECIMAL(10, 2) DEFAULT 0,
    dias_max_credito INT DEFAULT 30,
    tasa_interes_credito DECIMAL(5, 2) DEFAULT 0,
    moneda_oficial VARCHAR(3) DEFAULT 'GTQ',
    horario_atencion JSON, -- Usar JSON para definir horarios de atención
    multi_moneda BOOLEAN DEFAULT FALSE, -- Indicar si la empresa opera en múltiples monedas
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS movimiento_inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo_movimiento_id INT NOT NULL, -- Referencia al tipo de movimiento
    cantidad INT NOT NULL, -- Cantidad movida
    descripcion TEXT, -- Descripción del movimiento (razón del movimiento)
    usuario_id INT NOT NULL, -- Usuario que realiza el movimiento
    fecha_movimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (producto_id) REFERENCES producto(id),
    FOREIGN KEY (tipo_movimiento_id) REFERENCES tipos_movimiento_inventario(id), -- Relación con la tabla de tipos de movimiento
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE IF NOT EXISTS historial_movimientos (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    movimiento_inventario_id INT NOT NULL,
    descripcion TEXT,
    usuario_id INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (movimiento_inventario_id) REFERENCES movimiento_inventario(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE SET NULL,
    INDEX idx_movimiento_inventario_id (movimiento_inventario_id), -- Índices para mejorar consultas
    INDEX idx_usuario_id (usuario_id),
    INDEX idx_fecha (fecha)
);


CREATE TABLE IF NOT EXISTS proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(255),
    nit VARCHAR(50) NOT NULL,
    contacto VARCHAR(255), -- Persona de contacto
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS estado_factura_proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ejemplos: 'Pendiente', 'Pagado', 'Parcial'
    active BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS factura_proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proveedor_id INT NOT NULL,
    uuid VARCHAR(100) NOT NULL UNIQUE,
    numero_serie VARCHAR(50) NOT NULL, -- Serie de la factura del proveedor
    numero_factura VARCHAR(50) NOT NULL, -- Número de factura correlativo del proveedor
    fecha_factura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    estado_pago_id INT NOT NULL, -- Relación con estado de pago
    fecha_modificacion TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (proveedor_id) REFERENCES proveedor(id),
    FOREIGN KEY (estado_pago_id) REFERENCES estado_factura_proveedor(id) -- Estado del pago
);

CREATE TABLE IF NOT EXISTS factura_proveedor_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_proveedor_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (factura_proveedor_id) REFERENCES factura_proveedor(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE IF NOT EXISTS pago_proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_proveedor_id INT NOT NULL, -- Relación con factura del proveedor
    metodo_pago_id INT NOT NULL, -- Método de pago
    monto DECIMAL(10, 2) NOT NULL, -- Monto pagado
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (factura_proveedor_id) REFERENCES factura_proveedor(id),
    FOREIGN KEY (metodo_pago_id) REFERENCES metodo_pago(id)
);

-- Insertar los estados de pago iniciales para las facturas de proveedores
INSERT INTO estado_factura_proveedor (nombre) VALUES ('Pendiente'), ('Pagado'), ('Parcial');

-- Insertar los roles solicitados
INSERT INTO rol (nombre, descripcion) VALUES
('ADMIN', 'Administrador con todos los privilegios.'),
('GERENCIA', 'Rol asignado a la gerencia con permisos avanzados.'),
('BODEGA', 'Encargado de gestionar el inventario y las operaciones de la bodega.'),
('VENTAS', 'Encargado de gestionar las ventas y relaciones con los clientes.'),
('INVITADO', 'Rol con acceso limitado para visualizar información.');

-- Estados de Pedido
INSERT INTO estado_pedido (nombre) VALUES ('Pendiente'), ('Aceptado'), ('Completado'), ('Cancelado');

-- Métodos de Pago
INSERT INTO metodo_pago (nombre) VALUES ('Efectivo'), ('Tarjeta'), ('Transferencia'), ('Crédito');

-- Tipos de Movimiento Financiero
INSERT INTO tipo_movimiento (nombre) VALUES ('Ingreso'), ('Egreso');
