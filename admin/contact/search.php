    <div class="row">
        <div class="col-lg-12">
            <form method="post">
                <input type="text" name="name">
                <input type="submit" name="btn" value="جستجو"> <br /> <br />
            </form>


            <section class="panel">

                <header class="panel-heading">
                 لیست تلفن های ثبت شده
                </header>
                    <?php
                    if (isset($_POST['btn'])):

                        include_once 'app/db.php';
                        $obj->setTbl('contact_tbl');
                        $data = $_POST['name'];
                        $result = $obj->likeContact('name', $data);

                        ?>
                    <table class="table table-striped table-advance table-hover">
                        <thead>

                            <tr>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>شماره تماس </th>
                                <th>آدرس</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                           foreach($result as $value):
                        ?>

                            <tr>
                                <td><?php echo $value->name;?></td>
                                <td><?php echo $value->lastname;?></td>
                                <td><?php echo $value->tel;?></td>
                                <td><?php echo $value->address;?></td>
                                <td><a href="dashbord.php?contact=edit&id=<?php echo $value->id;?>" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a></td>
                                <td><a href="dashbord.php?contact=delete&id=<?php echo $value->id;?>" class="btn btn-danger btn-xs"><i class="icon-trash "></i></a></td>
                            </tr>

                           <?php endforeach; ?>

                        </tbody>
                    </table>

                <?php endif;?>

            </section>
        </div>
    </div>
