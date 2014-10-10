<h1>Category List</h1>
<?php
    echo $this->Html->link('Add Category', array('controller' => 'categories', 'action' => 'add'));
?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- ここから、$posts配列をループして、カテゴリリストの情報を表示 -->

    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['category_name'],
array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>
