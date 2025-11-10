Trước khi chạy, lên phpMyAdmin gõ: 
    ALTER TABLE users 
        ADD COLUMN failed_attempts INT DEFAULT 0, 
        ADD COLUMN last_failed_at DATETIME NULL, 
        ADD COLUMN locked_until DATETIME NULL;