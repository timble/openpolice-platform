<?
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
 ?>

<style type="text/css">
    /* Client-specific Styles */
    #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
    body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
    body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

    /* Reset Styles */
    body{margin:0; padding:0;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table td{border-collapse:collapse;}

    /* Template Styles */

    /* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: COMMON PAGE ELEMENTS /\/\/\/\/\/\/\/\/\/\ */

    /* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: HEADER /\/\/\/\/\/\/\/\/\/\ */

    /**
    * @tab Header
    * @section header text
    * @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
    */
    .headerContent{
        /*@editable*/ background-color:#0054ae;
        /*@editable*/ border-bottom:0;
        /*@editable*/ color:#FFF;
        /*@editable*/ font-family:Arial;
        /*@editable*/ font-weight:bold;
        /*@editable*/ line-height:100%;
        /*@editable*/ padding:10px 0;
        /*@editable*/ text-align:center;
        /*@editable*/ vertical-align:middle;
    }

    /**
    * @tab Header
    * @section header link
    * @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
    */
    .headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
        /*@editable*/ color:#FFF;
        /*@editable*/ font-weight:normal;
        /*@editable*/ text-decoration:underline;
    }

    /* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

    /**
    * @tab Body
    * @section body text
    * @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
    * @theme main
    */
    .bodyContent div{
        /*@editable*/ color:#505050;
        /*@editable*/ font-family:Arial;
        /*@editable*/ font-size:14px;
        /*@editable*/ line-height:150%;
        /*@editable*/ text-align:left;
    }

    /**
    * @tab Body
    * @section body link
    * @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
    */
    .bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
        /*@editable*/ color:#004d9f;
        /*@editable*/ font-weight:normal;
        /*@editable*/ text-decoration:underline;
    }

    .bodyContent hr {
        border: none 0;
        border-top: 1px dotted #d3d3d3;
        height: 1px;
        margin: 20px 0 0;
        padding: 20px 0 0;
    }
</style>
