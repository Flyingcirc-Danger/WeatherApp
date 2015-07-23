/**
 * Created by Tom_Bryant on 7/23/15.
 */

function parseChoices(jsonString){
    if(jsonString.length > 0) {
        var JSONObj = JSON.parse(jsonString);
        var result = '<ol>';
        for(i = 0; i < JSONObj.length; i++){
            result.append('<li>' +  JSONObj[i].name + '</li>' );
        }
        document.getElementById("choices").innerHTML(result);
    }
}
