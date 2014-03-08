function allowDrop(ev)
{
    ev.preventDefault();
}

function dragImage(ev)
{
    ev.dataTransfer.setData("id", ev.target.id);

    $jQuery( ".image" ).attr( "ondrop", "cloneElement(event)" );
    $jQuery( ".image" ).attr( "ondragover", "allowDrop(event)" );
}

function dragBlock(ev)
{
    ev.dataTransfer.setData("id", ev.target.id);

    $jQuery(".block").after('<div class="dropzone">Drop block here</div>');

    $jQuery( ".dropzone" ).attr( "ondrop", "moveElement(event)" );
    $jQuery( ".dropzone" ).attr( "ondragover", "allowDrop(event)" );
}

function removeDropzones(ev)
{
    $jQuery(".dropzone").remove();
}

function cloneElement(ev)
{
    ev.preventDefault();
    var data = ev.dataTransfer.getData("id");
    ev.target.appendChild(document.getElementById(data).clone());
}

function moveElement(ev)
{
    ev.preventDefault();
    var data = ev.dataTransfer.getData("id");
    $jQuery(ev.target).after(document.getElementById(data));
}