<?php
class Pagination
{
    private $item_per_page = 0;
    private $total_records = 0;
    private $total_page = 0;
    private $curr_page = 1;

    function __construct($item_per_page, $total_records)
    {
        $this->item_per_page = $item_per_page;
        $this->total_records = $total_records;
        $this->total_page = ceil($this->total_records / $this->item_per_page);
        if (isset($_GET['paging'])) {
            $this->curr_page = (int)$_GET['paging'];
        } else {
            $this->curr_page = 1;
        }
        $this->display_pagination();
    }

    function display_pagination()
    {
        $data_get = $_GET;
?>
        <ul class="pagination pagination-sm m-0 float-right">
            <?php
            if ($this->total_page <= 5) {
                if ($this->curr_page > 1) {
                    $data_get['paging'] = $this->curr_page - 1;
                    echo '<li class="page-item"><a class="page-link" href="?' . http_build_query($data_get) . '">&laquo;</a></li>';
                }
                for ($i = 0; $i < $this->total_page; $i++) {
                    $page = $i + 1;
                    $data_get['paging'] = $page;
                    echo '<li class="page-item"><a class="page-link" href="?' . http_build_query($data_get) . '">'.$page.'</a></li>';
                }
                if ($this->curr_page < $this->total_page) {
                    $data_get['paging'] = $this->curr_page + 1;
                    echo '  <li class="page-item"><a class="page-link" href="?' . http_build_query($data_get) . '">&raquo;</a></li>';
                }
            } else {
                if ($this->curr_page > 1) {
                    $data_get['paging'] = $this->curr_page - 1;
                    echo '<li class="page-item"><a class="page-link" href="?' . http_build_query($data_get) . '">&laquo;</a></li>';
                }
            ?>
                <?php
                $data_get['paging'] = 1;
                ?>
                <li class="page-item"><a class="page-link" href="?<?php echo http_build_query($data_get); ?>">1</a></li>
                <?php
                $data_get['paging'] = 2;
                ?>
                <li class="page-item"><a class="page-link" href="?<?php echo http_build_query($data_get); ?>">2</a></li>
                <li class="page-item"><span class="page-link">...</span></li>
                <?php
                $data_get['paging'] = $this->total_page - 1;
                ?>
                <li class="page-item"><a class="page-link" href="?<?php echo http_build_query($data_get); ?>"><?php echo $this->total_page - 1 ?></a></li>
                <?php
                $data_get['paging'] = $this->total_page;
                ?>
                <li class="page-item"><a class="page-link" href="?<?php echo http_build_query($data_get); ?>"><?php echo $this->total_page ?></a></li>
            <?php
                if ($this->curr_page < $this->total_page) {
                    $data_get['paging'] = $this->curr_page + 1;
                    echo '  <li class="page-item"><a class="page-link" href="?' . http_build_query($data_get) . '">&raquo;</a></li>';
                }
            }
            ?>
        </ul>
<?php
    }
}
