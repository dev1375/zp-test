# Test project

### 1. Resolve dependencies

```
composer update --no-dev
```

### 2. Check configs

Update `config.php` file

### 3. Create DB Schema

```
vendor/bin/doctrine orm:schema-tool:create
```

### 4. Run

```
php main.php
```

or
```
php main.php rubrics
```