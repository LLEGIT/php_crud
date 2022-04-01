$(document).ready(function () {
    // Displaying all the datas
    let update = false
    $.ajax({
        type: 'get',
        url: 'controller/get_all_infos.php',
        dataType: 'json',
        success: function (data) {
            data.forEach(row => {
                let li = document.createElement('li')
                li.innerHTML = `<span class='span_id'>${row[0]}</span> | <span class='span_name'>${row[1]}</span>` + " | " + `<span class='span_comment'>${row[2]}</span>` + "|" + "<a href='#' class='update'>Update</a>" + " | " + "<a href='#' class='delete'>Delete</a>"
                $('.infos-list').append(li)
            });

            // Update 
            $(".update").on("click", function () {
                update = true
                let id_content = $(this).closest('li').find('.span_id').html()
                let name = $(this).closest('li').find('.span_name').html()
                let comment = $(this).closest('li').find('.span_comment').html()
                $('form #name').val(name)
                $('form #comment').val(comment)
                $("form").attr("id", "update-form")
                $("#update-form").on("submit", function () {
                    let name_content = $('form #name').val()
                    let comment_content = $('form #comment').val()
                    $.ajax({
                        type: 'post',
                        url: 'controller/update_infos.php',
                        dataType: 'json',
                        data: {
                            id: id_content,
                            name: name_content,
                            comment: comment_content
                        }
                    })
                    update = false
                })
            })

            $(".delete").on("click", function() {
                if (update === false) {
                    let id_content = $(this).closest('li').find('.span_id').html()
                    $.ajax({
                        type: 'post',
                        url: 'controller/delete_infos.php',
                        dataType: 'json',
                        data: {id: id_content},
                    })
                    window.location.reload()
                }
            })

            // Sending data on submit
            $('#add-form').on('submit', function () {
                if (update === false) {
                    let name_content = $('form #name').val()
                    let comment_content = $('form #comment').val()
                    $.ajax({
                        type: 'post',
                        url: 'controller/add_infos.php',
                        dataType: 'json',
                        data: {
                            name: name_content,
                            comment: comment_content
                        }
                    })
                }
            })
        },
        error: function (data) {
            console.log(data)
        }
    })
})