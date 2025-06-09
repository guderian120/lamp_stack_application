<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $description, $id]);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task | Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-800">
                <i class="fas fa-edit mr-2"></i>Edit Task
            </h1>
            <a href="index.php" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6">
            <form method="POST" class="space-y-6">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" 
                           value="<?= htmlspecialchars($task['title']) ?>" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                </div>
                
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($task['description']) ?></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="index.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-1"></i> Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-resize textarea to fit content
        const textarea = document.getElementById('description');
        function adjustTextareaHeight() {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }
        
        textarea.addEventListener('input', adjustTextareaHeight);
        adjustTextareaHeight(); // Initial adjustment
    </script>
</body>
</html>