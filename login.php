<?php 
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS System | Log In Screen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="login.css" />
    <script src="login.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div class="wrapper">
        <div class="centered-column">
            <div class="logo"> 
                <div class="logo-img">
                    <img src="images/logo.PNG" alt="The Daily Catch Logo" height="75" width="75">
                </div>
                <div class="logo-text">
                    The Daily Catch
                </div>
            </div>
            <div class="instructions">
                Enter PIN
            </div>
            <div class="keypad-wrapper">
                <div class="keypad-frame">
                    
                    <div class="output">
                        <span class="pin" id="number-output"></span>
                    </div>

                    <div class="input">
                        <table class="keys">
                            <tr>
                                <td class="number">
                                    <button class="number-button" value="7" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        7
                                    </button>
                                </td>   
                                <td class="number">
                                    <button class="number-button" value="8" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        8
                                    </button>
                                </td>   
                                <td class="number">
                                    <button class="number-button" value="9" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        9
                                    </button>
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <button class="number-button" value="4" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        4
                                    </button>
                                </td>   
                                <td>
                                    <button class="number-button" value="5" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        5
                                    </button>
                                </td>   
                                <td>
                                    <button class="number-button" value="6" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        6
                                    </button>
                                </td>    
                            </tr>
                            <tr>
                                <td>
                                    <button class="number-button" value="1" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        1
                                    </button>
                                </td>   
                                <td>
                                    <button class="number-button" value="2" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        2
                                    </button>
                                </td>   
                                <td>
                                    <button class="number-button" value="3" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        3
                                    </button>
                                </td>    
                            </tr>
                            <tr>
                                <td>

                                </td>   
                                <td>
                                    <button class="number-button" value="0" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        0
                                    </button>
                                </td>   
                                <td>
                                    <button class="number-button" value="<" onclick="handleInput(this);" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                        <i class="material-icons">keyboard_return</i>
                                    </button>
                                </td>                                   
                            </tr>
                        </table>

                    </div>
                </div>
            </div>       
        </div>
        <div class="submit">                                 
            <button class="submit-button" value="Submit" onclick="validateInput();" 
            onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                Submit
            </button>
        </div>

        <div class="clear">                             
            <button class="clear-button" value="Clear" onclick="clearInput();" 
            onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                Clear
            </button>
        </div>     
    </div>
</body>
</html>