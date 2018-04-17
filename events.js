$('#editModal').on('show.bs.modal', function(e) {
							var productID = $(e.relatedTarget).data('product-ID');
							$(e.currentTarget).find('input[name="i_num"]').val(productID);
});
						
$('#deleteModal').on('show.bs.modal', function(e) {
							var productID = $(e.relatedTarget).data('product-ID');
							$(e.currentTarget).find('input[name="delete_num"]').val(productID);
});