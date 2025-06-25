<?php
$conn = new mysqli('localhost','root','','book_registration');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $quantity = $_POST['quantity'];

    if (!is_numeric($id)) {
        echo "
            <script>
                alert('Please enter a valid ID!');
                window.location.href = 'bookReg.php';
            </script>
        ";
        return;
    }

    if (strlen($id) > 11) {
        echo "
            <script>
                alert('Invalid ID!');
                window.location.href = 'bookReg.php';
            </script>
        ";
        return;
    }

    // Check dupes
    $sql = "SELECT id FROM tb_books";
    $rs = $conn->query($sql);

    while ($row = $rs->fetch_assoc()) {
        $ids[] = $row;
    }

    for ($i = 0; $i < count($ids); $i++) {
        if ($ids[$i]['id'] === $id) {
            echo "
            <script>
                alert('Book Registration Error: Duplicate ID found!');
                window.location.href = 'bookReg.php';
            </script>";
        }
    }

    $sql =
    "INSERT INTO tb_books
    (`id`,`book_name`,`author`,`publisher`,`quan`)
    VALUES
    (?,?,?,?,?)";

    $rs = $conn->prepare($sql);
    $rs->bind_param('sssss',$id,$bookname,$author,$publisher,$quantity);
    $rs->execute();
    echo "
        <script>
            alert('Book registered successfully!');
            window.location.href = 'bookReg.php';
        </script>
    ";
}

if (isset($_GET['delete'])) {
    $sql =  "DELETE FROM tb_books WHERE id='$_GET[delete]'";
    $rs = $conn->query($sql);

    echo "
        <script>
            alert('Book successfully deleted from records!');
            window.location.href = 'bookReg.php';
        </script>
    ";
}

if (isset($_GET['edit'])) {
    $sql = "UPDATE tb_books SET quan='$_GET[quan]' WHERE id='$_GET[id]'";
    $rs = $conn->query($sql);

    echo "
        <script>
            alert('Book edited successfully!');
            window.location.href = 'bookReg.php';
        </script>
    ";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DBActivity</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body {
            background-image: url(books.jpeg);
            background-color: rgba(225,225,225,0.8);
            background-blend-mode: lighten;
        }

        header {
            font-family: 'Times New Roman';
            background-color: #393E46;
            color: white;
            padding-top: 0.5rem;
            margin-bottom: 1rem;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        }

        div.registration, div.display {
            background-color: #EEEEEE;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        input {
            display: block;
            width: 100%;
            padding: 5px 5px 5px 2.5px;
            font-size: 16px;
            font-weight: 400;
            border: none;
            border-bottom: 1px solid #212529;
            background: transparent;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: black;
        }

        div.registration input::placeholder {
            color: #272b2f;
        }

        input:focus::placeholder, div.registration input:focus::placeholder {
            color: transparent;
        }

        label.form-label {
            margin-bottom: 0;
        }
        
        button.btn.btn-primary {
            background-color: #393E46;
            border-color: #393E46;
        }

        button.btn.btn-primary:hover {
            background-color: #222831;
            border-color: #222831   ;
        }

        th:nth-child(1) {
            border-top-left-radius: 10px;
        }

        th:nth-child(6) {
            border-top-right-radius: 10px;
        }

        table.table > tbody > tr:last-child > td:nth-child(1) {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        table.table {
            width: 100%;
            height: 95% !important;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            border-color: #272b2f;
            border-radius: 10px;
            /* box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; */
        }

        table, th, tr, td {
            background-color: #EEEEEE !important;
            color: #212529;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container justify-content-center">
                <h4><strong>Book Registration and Display</strong></h4>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row g-4">

            <div class="col">
                <div class="container registration">
                    <div class="row">
                        <h5><strong>Register Book</strong></h5>
                    </div>
                    <div class="row">
                        <form method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label for="idInput" class="form-label">ID</label>
                                <input name="id" id="idInput" type="text" maxlength="11" placeholder="...012" required>
                            </div>
                            <div class="mb-3">
                                <label for="bookNameInput" class="form-label">Book Name</label>
                                <input name="bookname" id="bookNameInput" type="text" placeholder="...Danny's Book" required>
                            </div>
                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Author</label>
                                <input name="author" id="authorInput" type="text" placeholder="...Danny" required>
                            </div>
                            <div class="mb-3">
                                <label for="publisherInput" class="form-label">Publisher</label>
                                <input name="publisher" id="publisherInput" type="text" placeholder="...Danny's Publishing" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantityInput" class="form-label">Quantity</label>
                                <input name="quantity" id="quantityInput" type="number" min="1" value="1" required>
                            </div>
                            <button name="submit" class="btn btn-primary" type="submit" class="btn btn-submit">Submit</button>
                        </form>
                    </div>            
                </div>
            </div>

            <div class="col-9">
                <div class="container display">
                    <div class="row g-2">
                        <div class="container" style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
                            <input id="searchInput" placeholder="search a book by name...">
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="contatiner" style="height: 500px; overflow: auto; margin-top: 0.5rem;">
                            <table class="table table-borderless table-striped">
                                <tr>
                                    <th scope="col" style="width: 110.88px;">ID</th>
                                    <th scope="col" style="width: 172.03px;">Book Name</th>
                                    <th scope="col" style="width: 154.14px;">Author</th>
                                    <th scope="col" style="width: 154.14px;">Publisher</th>
                                    <th scope="col" style="width: 85.63px;">Quantity</th>
                                    <th scope="col" style="width: 154.19px;">Actions</th>
                                </tr>
                                <?php
                                $sql = "SELECT * FROM tb_books";
                                $rs = $conn->query($sql);

                                if ($rs->num_rows === 0) {
                                    echo "<h5 style='text-align: center;'>No Books Registered Yet</h5>";
                                } else {
                                    while ($row = $rs->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>" . $row['id'] ."</td>
                                            <td>" . $row['book_name'] ."</td>
                                            <td>" . $row['author'] ."</td>
                                            <td>" . $row['publisher'] ."</td>
                                            <td>" . $row['quan'] ."</td>
                                            <td>
                                                <div class='row'>
                                                    <div class='col'>
                                                <form action='bookReg.php'>
                                                    <input type='text' name='delete' value='" . $row['id'] . "' style='display: none;'>
                                                    <button class='btn btn-danger' id='deleteRow'><i class='material-icons'>delete</i></button>
                                                </form>
                                                    </div>
                                                    <div class='col'>
                                                <div data-id='" . $row['id'] . "' data-bookname='" . $row['book_name'] . "' data-quantity='" . $row['quan'] . "'> 
                                                    <button class='btn btn-warning' id='editQuantity' data-bs-toggle='modal' data-bs-target='#editModal'>
                                                        <i class='material-icons'>edit</i>
                                                    </button>
                                                </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Quantity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="bookReg.php">
                        <input name="edit" value="true" style="display: none;">

                        <label for="id" class="form-label">Book ID</label>
                        <input name="id" id="id" readonly>

                        <label for="name" class="form-label">Book Name</label>
                        <input name="name" id="name" readonly>

                        <label for="quan" class="form-label">Quantity</label>
                        <input name="quan" id="quan" type="number" min="1">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            let searchInputVal = searchInput.value.toLowerCase();
            const tbrows = document.querySelectorAll('tr');
            tbrows.forEach(tr => {
                if (searchInputVal === '') {
                    tr.style.display = 'table-row';
                } else {
                    if (tr.querySelector('td:nth-child(2)') === null) {
                        return null;
                    } else {
                        let name = tr.querySelector('td:nth-child(2)').innerHTML.toLowerCase();
                        if (name.includes(searchInputVal)) {
                            tr.style.display = 'table-row';
                        } else {
                            tr.style.display = 'none';
                        }
                    }
                }
            });
        });

        const deleteBtns = document.querySelectorAll('#deleteRow');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Delete record?') === true) {
                    btn.parentElement.submit();
                }
            });
        });

        const editBtns = document.querySelectorAll('#editQuantity');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = document.getElementById('editModal');
                modal.querySelector('#id').value = btn.parentElement.dataset.id;
                modal.querySelector('#name').value = btn.parentElement.dataset.bookname;
                modal.querySelector('#quan').value = btn.parentElement.dataset.quantity;

                modal.querySelector('#saveChanges').addEventListener('click', function() {
                    modal.querySelector('form').submit();
                });
            });
        });
    </script>
</body>
</html>