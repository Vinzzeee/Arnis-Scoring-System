
  $(document).ready(function() {
    // Hide all user info rows initially
    $('.user-info-row').hide();
    
    // Add click event listener to each user row
    $('.user-row').click(function() {
      // Get the next row, which is the user info row
      var userInfoRow = $(this).next('.user-info-row');
      
      // Toggle the visibility of the user info row
      userInfoRow.slideToggle();
    });
  });
