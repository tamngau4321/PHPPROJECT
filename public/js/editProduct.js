function changePic()
{
    photo.src = URL.createObjectURL(event.target.files[0]);
}