<div>
    <h1>Category Name</h1>
    <p><strong><?php echo h($category['Category']['category_name']);?></strong>
    <small>Created: <?php echo $category['Category']['created'];?></small></p>
</div>
<hr />
<div>
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Action</th>
            <th>Created</th>
        </tr>

        <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($post['Post']['title'],
    array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
            </td>
            <td>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
                <?php echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?'));
                ?>
            </td>
            <td><?php echo $post['Post']['created']; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($post); ?>
    </table>
</div>
