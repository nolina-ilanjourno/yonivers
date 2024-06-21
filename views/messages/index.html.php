<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Message</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Create Message</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $field => $fieldErrors): ?>
                        <?php foreach ($fieldErrors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="/" method="post" novalidate>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?= isset($message) ? $message->email : "" ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="message">
               <?= isset($message) ? $message->message : "" ?>
            </textarea>
            <button type="submit">Create message</button>
        </form>
    </div>
</body>
</html>
