<!DOCTYPE html>
<html>
        <head>
                <meta charset="UTF-8">
                <title>Trello JSON 2 PDF</title>
        </head>
        <body style="font-family:sans-serif;">
                <form action="" method="post" enctype="multipart/form-data" style="width:450px;height:400px;position:fixed;top:0;bottom:0;left:0;right:0;margin:auto;text-align:center;line-height:1.5;font-size:1.3em">
                        <h1 style="line-height:1.2">Nástroj na konverziu trello JSONu do PDF</h1>
                        <label>
                                <input type="radio" name="type" value="sprint"> Sprint backlog
                        </label>
                        <label>
                                <input type="radio" name="type" value="product"> Product backlog
                        </label>
                        <br><br>
                        <input type="file" name="json" style="font-size:1.2em;">
                        <br><br>
                        <input type="submit" value="Konvertovať JSON do PDF »" style="font-size:1.2em;padding:10px 20px">
                </form>
        </body>
</html>
