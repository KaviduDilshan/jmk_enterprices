

function delete_record(id, tbl, id_name, type) {


    swal({
        title: "Are you sure?",
        text: "Do You want Deactivate  this account",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Deactivated',
                text: 'Account Sucessfully deactivated',
                icon: 'success'
            }).then(function () {

                var data = {
                    id: id,
                    tbl: tbl,
                    id_name: id_name

                };

                $.ajax({
                    type: "POST",
                    url: "./data/deact.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {

                        switch (data.res) {
                            case 1:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 2:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 3:
                                window.location.href = "currency_list.php";
                                break;
                            case 4:
                                window.location.href = "currency_list.php";
                                break;
                            case 5:
                                window.location.href = "user_list.php";
                                break;
                            case 6:
                                window.location.href = "user_list.php";
                        }

                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}



function activate_record(id, tbl, id_name, type) {

    swal({
        title: "Are you sure?",
        text: "Do You want Activate  this account",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Activated',
                text: 'Account Sucessfully Activated',
                icon: 'success'
            }).then(function () {

                var data = {
                    id: id,
                    tbl: tbl,
                    id_name: id_name,

                };

                $.ajax({
                    type: "POST",
                    url: "./data/act.php",
                    dataType: 'json',
                    data: data,

                    success: function (data) {

                        switch (data.res) {
                            case 1:
                                window.location.href = "admin_list.php?type=" + type;
                                break;
                            case 2:
                                window.location.href = "admin_list.php?type=" + type;

                            case 3:
                                window.location.href = "currency_list.php";
                                break;
                            case 4:
                                window.location.href = "currency_list.php";
                                break;
                            case 5:
                                window.location.href = "user_list.php";
                                break;
                            case 6:
                                window.location.href = "user_list.php";
                        }



                    }
                });



            });
        } else {
            swal("Cancelled", "User Not Deactivated", "error");
        }
    });

}




 