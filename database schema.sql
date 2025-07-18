CREATE TABLE cars (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    -- Car identification
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    model_year YEAR NOT NULL,

    -- Vehicle specifications
    body_style VARCHAR(50) NOT NULL, -- SUV, Sedan, Hatchback, etc.
    type VARCHAR(50) NOT NULL, -- vehicle category
    fuel_type VARCHAR(20) NOT NULL, -- petrol/diesel
    transmission_type VARCHAR(20) NOT NULL, -- Automatic, Manual, etc.
    drive_type VARCHAR(20) NOT NULL, -- FWD, RWD, AWD, etc.

    -- Physical attributes
    color VARCHAR(50) NOT NULL,

    -- Performance & condition
    mileage INT UNSIGNED NOT NULL, -- Total kilometers driven
    speed INT UNSIGNED, -- Max speed or current speed rating
    vehicle_status VARCHAR(20) NOT NULL DEFAULT 'New', -- New, Used, etc.
    refurbishment_status VARCHAR(50), -- Refurbishment status if applicable

    -- Pricing
    price DECIMAL(12, 2) NOT NULL, -- Sale price
    discount DECIMAL(8, 2) DEFAULT 0, -- Discount amount
    monthly_installment DECIMAL(10, 2), -- Monthly payment option

    -- Classification
    category VARCHAR(50) NOT NULL, -- 1st Category (trim/grade)

    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Indexes for common queries
    INDEX idx_brand_model (brand, model),
    INDEX idx_price_range (price),
    INDEX idx_year_type (model_year, type),
    INDEX idx_fuel_transmission (fuel_type, transmission_type)
);
