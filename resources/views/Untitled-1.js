

$.ajax({
    url: "http://localhost/your_project/public/add-user",
    type: "POST",
    data: {
        name: "John",
        email: "john@example.com",
        age: 25
    },
    success: function(response) {
        alert(response.message);
    }
});


$.ajax({
    url:'',
    type:'post',
    data:{
        name : "abhishek"
    },
    success:function(response){
        console.log(response);

    }
})