
    jQuery(document).ready(function () {
        
        
        jQuery('.add-another-collection').click(function (e) {
            
            e.preventDefault();
            
            var collectionList = $(this).parent().parent().parent().parent();
            
            var index = collectionList.find('tbody').find("tr").length;
            
            // grab the prototype template
            var newWidget = collectionList.attr('data-prototype');
            
            // replace the "__name__" used in the id and name of the prototype
            // with a number that's unique to your emails
            // end name attribute looks like name="contact[emails][2]"
            newWidget = newWidget.replace(/__name__/g, index);
            
            // create a new list element and add it to the list
            var newTr = jQuery('<tr></tr>').html(newWidget);
            newTr.appendTo(collectionList);
            
        });

        // handle the removal, just for this example
        $(document).on('click', '.remove-collection', function (e) {
            e.preventDefault();

            $(this).parent().parent().remove();

            return false;
        });
    })

