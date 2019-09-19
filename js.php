<script src="css/toast-master/js/jquery.toast.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('contents').style.visibility="visible";
      },1000);
  }
}
</script>

<script>
    (function ($) {

        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
            searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function (decorated) {

            // invoke parent method
            var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

            this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

            return $rendered;
        };

    })(window.jQuery);
</script>

<script type="text/javascript">

    function PopupCenter(url, title, w, h, urlId, btnElm) {
        // update button visibility status
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "setVisibilityStatus",
                "urlId": urlId
            }
        }).always(function (res) {
            $(btnElm).find('span.vis-text').text('VISITED');
        });

        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }

</script>
<div id='div_session_write'></div>
<script type="text/javascript">

    putCatsInSelect();

    // Get all categories and put them into option
    function putCatsInSelect() {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "getCategories"
            },
            success: function (categories) {
                $("#selectOFCategories").html(categories);
                $('#selectOFCategories').select2({
                    placeholder: "Select One Category",
                    allowClear: true,
                    searchInputPlaceholder: 'Start typing...'
                });

            }
        });
    }

    // Changing notes of url on blur
    function changeNote(elem) {
        let noteText = elem.value;
        let urlId = elem.id.split('-')[2];
        elem.disabled = true;

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "updateNote",
                "urlId": urlId,
                "newNote": noteText
            }
        }).always(function () {
            elem.disabled = false;
        });
    }

    // BUG!!! Need reload
    function saveCategories() {
        let categories = document.getElementById("saveCategoriesTextarea").value.split('\n');

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "addCategories",
                "categories": JSON.stringify(categories)
            },
            success: function (categoriesJson) {
                putCatsInSelect();
            }
        });

    }

    // Need reload
    function deleteCategory() {

        let selectOfCategories = document.getElementById("selectOFCategories");
        let selectedId = null;

        for (let i = 0; i < selectOfCategories.length; i++) {
            if (selectOfCategories.options[i].selected) {
                selectedId = selectOfCategories.options[i].value;
            }
        }
        if (selectedId == 10) {
            message("Default category can't be Deleted!", 2);
            setTimeout(function () {
                window.location.reload();
            }, 500);
        } else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    "action": "deleteCategory",
                    "id": selectedId
                },
                success: function () {
                    // putCatsInSelect();
                    message("Category Successfully Deleted!", 1);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                    getTableContents();
                }
            });
        }
    }

    function updateProgress(percent, reset = false) {
        let bar = $('.progress-bar');
        bar.css('display', 'block');
        bar.css('width', `${percent}%`);
        bar.find('.progress-text').text(`${percent}%`);

        if (reset === true) {
            bar.css('display', 'none');
            bar.css('width', `0%`);
            bar.find('.progress-text').text(`0%`);
        }
    }

    function fileuplode() {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "fileuplode",
                "urls": JSON.stringify(newUrls)
            },
            success: function (data) {
                alert(data);
            }
        });
    }

    function addLinks(btn) {

        let linkInput = document.getElementById("links");
        let pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        let listOfLinks = linkInput.value.split('\n').filter(function (item) {
            return item.length && pattern.test(item);
        });

        if (!listOfLinks.length) {
            alert('Please input links / Check that all links are valid');
            return false;
        }

        let category = $("#selectOFCategories option:selected").text();
        if (category == "All") {
            message("Please choose a category first!", 2);
            setTimeout(function () {
                window.location.reload();
            }, 500);
            return false;
        }

        if (category == "Select One Category") {
            message("Please choose a category first!", 2);
            setTimeout(function () {
                window.location.reload();
            }, 500);
            return false;
        }

        $('#addLinksButton').html('<span class="spinner-border" role="status" aria-hidden="true"></span> Loading...');
        btn.disabled = true;


        let contact = $(".contact").val();
        let approve = $(".approve").val();
        let type = $("#type option:selected").text();

        let progressPercent = 10;
        let del = Math.floor(15 / listOfLinks.length);
        del = del - (del % 10);

        // init progress
        updateProgress(progressPercent);

        let timer = setInterval(function () {
            progressPercent += del;
            if (progressPercent <= 100) {
                updateProgress(progressPercent);
            }
        }, 1500);

        let newUrls = listOfLinks.map(function (item) {
            return {
                urlString: item,
                category: category,
                contact: contact,
                type: type,
                approve: approve
            };
        });
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "addSomeUrls",
                "urls": JSON.stringify(newUrls)
            },
            success: function (data) {

            }
        }).always(function () {
            clearInterval(timer);
            btn.disabled = false;
            linkInput.value = '';
            updateProgress(100);

            if (approve == 1) {
                message('Your listing Add successfully!', 1);
            } else {
                message('Your listing is pending. Admin will approve it soon!', 1);
            }
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        });

    }

    var i = '<?= $i++; ?>';
    var remote_addr = "<?= $_SERVER['REMOTE_ADDR']?>";

    setInterval(function () {
        getTableContents();
    }, 60000);

    function delete_links(id, btn) {
        $('#checkbox_' + id).attr('checked', true);
        deleteLinks(btn);
    }

    function deleteLinks(btn) {
        let checkedLinksToDelete = $('.linkCheckbox:checked');
        if (!checkedLinksToDelete.length) {
            alert('Please select links to delete');
            return;
        }

        let deleteLoader = $('.delete-loader');
        let opCount = 0;
        btn.disabled = true;
        deleteLoader.css('visibility', 'visible');
        checkedLinksToDelete.each(function () {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    "action": "deleteUrl",
                    "urlId": this.value
                }
            }).always(function () {
                opCount++;
                if (opCount == checkedLinksToDelete.length) {
                    btn.disabled = false;
                    deleteLoader.css('visibility', 'hidden');
                    message('Your listing is successfully Deleted!', 1);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                }
            });
        });
    }

    function selectMultiLinksForDelete(el) {
        $('.linkCheckbox').prop('checked', el.checked);
    }

    function reloadScreen(urlId, url) {
        var relimg = urlId;
        var newString = urlId.split('_', 2)[1];
        relimg = urlId;
        var cimg = document.getElementById(relimg);
        var path = "screenshot.php?url=" + url;
        cimg.src = path;
        if (cimg.src.includes('&reload=1')) {
            cimg.src += '1';
        } else {
            cimg.src += '&reload=1';
        }
        handle_reload(cimg);

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "refreshImage",
                "urlId": newString
            },
            beforeSend: function () {
                $('img.spinner[data-target="' + relimg + '"]').show();
                $('a.reload-handle[data-target="' + relimg + '"]').hide();
            },
            success: function (screenSrc) {

                cimg.src = 'http://' + '<?= $_SERVER['SERVER_NAME']?>' + '/coder/links/' + screenSrc;
            }
        });
    }

    function message(mess, name) {
        if (name == 1) {
            jQuery('#div_session_write').load('setsessionvariable.php?name=success_message&value=' + encodeURI(mess));
        } else {
            jQuery('#div_session_write').load('setsessionvariable.php?name=error_message&value=' + encodeURI(mess));
        }
    }

    function success_message(data) {
        var message = '<div class="alert alert-danger fade in alert-dismissable" id="flash-msg" >' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>' +
            '<strong>Success!</strong> ' + data
        '</div>';
        $("#alert_message").html(message);
        // $("#flash-msg").delay(3000).fadeOut("slow");
        /*
        $.toast({
            heading: 'Success!',
            text: data,
            position: 'top-right',
            loaderBg:'#8ec657',
            icon: 'success',
            hideAfter: 4000,
            stack: 6
        });
        */
    }

    function error_message(data) {

        var message = '<div class="alert alert-danger fade in alert-dismissable" id="flash-msg" >' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>' +
            '<strong>Error!</strong> ' + data
        '</div>';
        $("#alert_message").html(message);
        $("#flash-msg").delay(3000).fadeOut("slow");
        /*
        $.toast({
            heading: 'Error!',
            text: data,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 4000
        });
        */
    }

    function getTableContents() {
        requestFromPage = $(".contentDataTable").data("value");
        selectOfCategories = document.getElementById("selectOFCategories");
        selectedCategory = $('#selectOFCategories option:selected').text();

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "getTableContents",
                "requestFromPage": requestFromPage,
                "selectedCategory": selectedCategory
            },
            success: function (data) {
                $("#tbodyOfLinks").html(data);

                setTimeout(buildCategoryTable, 2000);
            }
        });
    }

    function buildCategoryTable() {
        // $('#example1').DataTable();

        $('#example1').dataTable({
            destroy: true,
            "pageLength": 25
        });

        checkSuccessMessage();
    }

    getTableContents();

    function shareModalPopup(shareVal) {
        url = $(shareVal).data('url');
        title = $(shareVal).data('title');

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "shareModalPopup",
                "url": url,
                "title": title
            },
            success: function (data) {
                $("#shareModalContent").html(data);

                $("#ShareModal").modal('show');
            }
        });
    }

    function checkSuccessMessage(){
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "action": "checkSuccessMessage"
            },
            success: function (result) {
                dataResult = JSON.parse(result);

                switch (dataResult['showMessage']) {
                    case "show":
                        $("#messageDiv").show();
                        break;
                    case "hide":
                        $("#messageDiv").hide();
                        break;
                }

            }
        });
    }
</script>
<?php
if (isset($_SESSION['success_message'])) { ?>
    <script>
        //success_message("<?//= $_SESSION['success_message'] ?>//")
    </script>
    <?php
//    session_unset();
}
if (isset($_SESSION['error_message'])) {
    ?>
    <script>
        error_message("<?= $_SESSION['error_message'] ?>")
    </script>
    <?php
    session_unset();
}
?>
<script type="text/javascript">
    function toggler(el) {
        $('img.spinner[data-target="' + el.id + '"]').hide();
        $('a.reload-handle[data-target="' + el.id + '"]').show();
    }

    function handle_reload(imgEl) {
        var id = imgEl.id;
        $('img.spinner[data-target="' + imgEl.id + '"]').show();
        $('a.reload-handle[data-target="' + imgEl.id + '"]').hide();

        imgEl.onload = function () {
            toggler(imgEl);
        };
    }

    $('img.ss-img').on('load', function () {
        toggler(this);
    }).each(function () {
        if (this.complete) {
            toggler(this);
        }
    });

    function reloadimg(relimg) {

        var cimg = document.getElementById(relimg);
        if (cimg.src.includes('&reload=1')) {
            cimg.src += '1';
        } else {
            cimg.src += '&reload=1';
        }
        handle_reload(cimg);
    }
</script>

