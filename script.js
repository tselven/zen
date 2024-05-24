function copyCode() {
    var codeElement = document.getElementById("code");
    var textToCopy = codeElement.innerText || codeElement.textContent; // Get the text content
    
    // Create a temporary textarea element
    var tempTextarea = document.createElement("textarea");
    tempTextarea.value = textToCopy; // Set its value to the text content
    
    // Append the textarea to the document
    document.body.appendChild(tempTextarea);
    
    // Select the text in the textarea
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, tempTextarea.value.length); // For mobile devices
    
    // Copy the selected text to the clipboard
    document.execCommand("copy");
    
    // Remove the temporary textarea
    document.body.removeChild(tempTextarea);
    
    // Alert the user
    alert("Text copied to clipboard!");
}

