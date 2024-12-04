<script>
document.getElementById("saveButton").addEventListener("click", () => {
    const formData = {
        container: document.getElementById("container").value.trim(),
        pallet: document.getElementById("pallet").value.trim(),
        position: document.getElementById("position").value.trim(),
        remarks: document.getElementById("remarks").value.trim(),
        poly_size: document.getElementById("poly_size").value.trim(),
        quantity: document.getElementById("quantity").value.trim(),
        others: document.getElementById("others").value.trim(),
        scanned_by: document.getElementById("username").value.trim(),
        date_time: new Date().toISOString()
    };

 
    const requiredFields = ['container', 'pallet', 'position', 'poly_size', 'quantity', 'scanned_by'];
    if (requiredFields.some(field => formData[field] === "")) {
        Swal.fire({
            title: 'Error!',
            text: 'Please fill in all required fields.',
            icon: 'error',
            showConfirmButton: true
        });
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../process/inventory_save.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () => {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText); 
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message, 
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        document.querySelector("form").reset();
                        fetchData();
                        window.location.reload(); 
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to save the record.',
                        icon: 'error',
                        showConfirmButton: true
                    });
                }
            } catch (error) {
                console.error('Invalid JSON response', xhr.responseText);
                Swal.fire({
                    title: 'Error!',
                    text: 'Unexpected response from the server.',
                    icon: 'error',
                    showConfirmButton: true
                });
            }
        } else {
            Swal.fire({
                title: 'Error!',
                text: `Server error: ${xhr.status}`,
                icon: 'error',
                showConfirmButton: true
            });
        }
    };

    xhr.onerror = () => {
        Swal.fire({
            title: 'Error!',
            text: 'Network error occurred.',
            icon: 'error',
            showConfirmButton: true
        });
    };

    xhr.send(`data=${encodeURIComponent(JSON.stringify(formData))}`);
});

document.addEventListener('DOMContentLoaded', () => {
    fetchData();
    refreshDateTime(); 
    setInterval(refreshDateTime, 1000); 
});

function refreshDateTime() {
    const datetimeDisplay = document.getElementById("datetime");
    const now = new Date();

    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString(undefined, dateOptions);

    const timeOptions = { hour: 'numeric', minute: 'numeric', second: 'numeric' };
    const formattedTime = now.toLocaleTimeString(undefined, timeOptions);

    datetimeDisplay.textContent = `${formattedDate} | ${formattedTime}`;
}



document.addEventListener("DOMContentLoaded", function () {
   
    fetchData();


    document.getElementById('admin_body').addEventListener('click', function (event) {
        const clickedRow = event.target.closest('tr'); 

        if (clickedRow) {
            const rowId = clickedRow.dataset.id;  
     
            if (!rowId || rowId === 'undefined') {
                alert('ID is missing or undefined!');
                return;
            }

            const rowData = Array.from(clickedRow.children).map(cell => cell.textContent.trim());


            document.getElementById('edit_container').value = rowData[0] || ''; 
            document.getElementById('edit_pallet').value = rowData[1] || '';   
            document.getElementById('edit_position').value = rowData[2] || ''; 
            document.getElementById('edit_poly_size').value = rowData[3] || ''; 
            document.getElementById('edit_quantity').value = rowData[4] || '';  
            document.getElementById('edit_remarks').value = rowData[5] || '';   
            document.getElementById('edit_others').value = rowData[6] || '';  

         
            const scannedBy = document.getElementById('username').value || ''; 
            document.getElementById('edit_scanned_by').value = scannedBy; 

          
            $('#editModal').modal('show');
            
            
            document.getElementById('editModal').dataset.id = rowId;  
        }
    });





    document.getElementById('editSaveButton').addEventListener('click', function () {
        const container = document.getElementById('edit_container').value;
        const pallet = document.getElementById('edit_pallet').value;
        const position = document.getElementById('edit_position').value;
        const polySize = document.getElementById('edit_poly_size').value;
        const quantity = document.getElementById('edit_quantity').value;
        const remarks = document.getElementById('edit_remarks').value;
        const others = document.getElementById('edit_others').value;
        const scannedBy = document.getElementById('edit_scanned_by').value;
        const id = document.getElementById('editModal').dataset.id; 

     
        if (!container || !pallet || !position || !polySize || !quantity || !remarks || !others || !scannedBy) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields are required!',
            });
            return;
        }

        fetch('../../process/inventory_update.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,  
                container: container,
                pallet: pallet,
                position: position,
                polySize: polySize,
                quantity: quantity,
                remarks: remarks,
                others: others,
                scannedBy: scannedBy
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    timer: 1000,  
                    showConfirmButton: false,  
                    text: 'Record updated successfully.',
                }).then(() => {

                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update record.',
                });
            }
        })
        .catch(error => {
            console.error('Error updating record:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while updating the record.',
            });
        });
    });
});

{
document.getElementById('editDeleteButton').addEventListener('click', function () {
    const id = document.getElementById('editModal').dataset.id;

    if (!id) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Record ID is missing or invalid.',
        });
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: 'This action will permanently delete the record.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../../process/inventory_delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The record has been deleted.',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete record.',
                    });
                }
            })
            .catch(error => {
                console.error('Error deleting record:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while deleting the record.',
                });
            });
        }
    });
});


document.getElementById('searchBtn').addEventListener('click', function() {
    currentPage = 1; 
    document.getElementById('admin_body').innerHTML = ''; 
    fetchData();
});



{
}

document.getElementById('editContainerScan').addEventListener('click', function () {
    scanQRCodeEdit('edit_container');
});
document.getElementById('editPalletScan').addEventListener('click', function () {
    scanQRCodeEdit('edit_pallet');
});
 }







</script>
