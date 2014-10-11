<div>
    <h1>Category Name</h1>
    <p><strong><?php echo h($data['Category']['category_name']);?></strong>
    <small>Created: <?php echo $data['Category']['created'];?></small></p>
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

        <?php foreach ($data['Post'] as $post): ?>
        <tr>
            <td><?php echo $post['id']; ?></td>
            <td>
                <?php echo $this->Html->link($post['title'],
    array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
            </td>
            <td>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['id'])); ?>
                <?php echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['id']),
                    array('confirm' => 'Are you sure?'));
                ?>
            </td>
            <td><?php echo $post['created']; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($post); ?>
    </table>
</div>
