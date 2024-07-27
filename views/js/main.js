/* Activate Datatable */
$('.data-tables').DataTable();
/* Inputmasks */
//Datemask dd/mm/yyyy
$('#newBirthdate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#editBirthdate').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()