<!DOCTYPE html>
<html>
<head></head>
<body>
    <h1>Welcome</h1>
    <p>Hello <?php echo htmlspecialchars($name);?></p>
    <?php foreach($colour as $colours) : ?>
        <li><?php echo htmlspecialchars($colours);?></li>
    <?php endforeach; ?>
</body>
</html>