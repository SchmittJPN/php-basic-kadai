<?php
session_start();

// POSTリクエストから入力データを取得
$name = $_POST['user_name'];
$age = $_POST['user_age'];
$department = $_POST['user_department'];

// エラーメッセージを格納する配列
$errors = []; // 最初はエラーなし

// 社員名のバリデーション
if (empty($name) ) {
    $errors[] = '社員名を入力してください。';
}

// 年齢のバリデーション
if (empty($age) ) {
    $errors[] = '年齢を入力してください。';
} elseif (!is_numeric($age)) {
    $errors[] = '年齢は数字で入力してください。';
} elseif ($age < 18 || $age > 100) {
    $errors[] = '年齢は18以上100以下で入力してください。';
}

// 所属部署のバリデーション
if (empty($department) ) {
    $errors[] = '所属部署を選択してください。';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF=8">
    <title>PHP基礎編</title>
</head>

<body>
    <h2>入力内容をご確認ください。</h2>
    <p>問題なければ「確定」、修正する場合は「キャンセル」をクリックしてください。</p>

    <table border="1">
        <tr>
            <th>項目</th>
            <th>入力内容</th>
        </tr>
        <tr>
            <td>社員名</td>
            <td><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>年齢</td>
            <td><?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>所属部署</td>
            <td><?php echo htmlspecialchars($department, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    </table>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <!-- 確定ボタンとキャンセルボタン -->
        <form action="complete.php" method="post">
            <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="user_age" value="<?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="user_department" value="<?php echo htmlspecialchars($department, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="submit" value="確定" <?php echo (!empty($errors)) ? 'disabled style="background-color: #ccc; color: #666;"' : ''; ?>>
        </form>

        <!-- キャンセルボタン -->
        <form action="form.php" method="post">
            <input type="submit" value="キャンセル">
        </form>
    </div>
</body>
</html>