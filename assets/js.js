console.log("heelo")
$(document).ready( function () {
    $('#myTable').DataTable();
} );


// let edits=document.getElementsByClassName("edits");
// console.log(typeof(edits));
// Array.from(edits).forEach((element) => {
//         element.addEventListener("click",(e)=>{
//             console.log("edit");
//             let tr=e.target.parentNode.parentNode;
//             title=tr.getElementsByTagName("td")[0].innerText;
//             desc=tr.getElementsByTagName("td")[1].innerText;
//             console.log(title,desc);
//             titleEdit.value=title;
//             desEdit.value=desc;
//         })
// });






let edit=document.getElementsByClassName("edits");

Array.from(edit).forEach((element) => {
    element.addEventListener("click",(e)=>{
        console.log(e);
        let tr=e.target.parentNode.parentNode;
        let title=tr.getElementsByTagName("td")[0].innerText;
        let desc=tr.getElementsByTagName("td")[1].innerText;

        titleEdit.value=title;
        desEdit.value=desc;
        snoEdit.value=e.target.id;
        console.log(e.target.id);

    })
});

let deletes=document.getElementsByClassName("deletes");


Array.from(deletes).forEach((element) => {
        element.addEventListener("click",(e)=>{

            let sno=e.target.id.substr(1);
            window.location=`/CRUD_APP/index.php?deletes=${sno}`;

            console.log("Done");
            if(confirm("Are You Sure You Want To delete it?")){
                console.log("yes");
            }
            else{
                console.log("no");
            }

        })
});




// array.from().forEach(element => {
    
// });