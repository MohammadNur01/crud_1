<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>CRUD 1</title>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud_1') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>

        <div class="row justify-content-center">
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="<?= $name; ?>" require>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Enter your location" value="<?= $location; ?>" require>
                </div>
                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>

                </div>
            </form>
        </div>
        <!-- Awal Card Tabel -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                List
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No. </th>
                        <th>Name </th>
                        <th>Location </th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete this data?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <?php
                function pre_r($array)
                {
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }
                ?>
            </div>
            <!-- Penutup Tabel -->
        </div>




        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


</body>

</html>