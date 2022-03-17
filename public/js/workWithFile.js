let showImage = document.querySelector('#showImage');
let fileImage = document.querySelector('#image');
let deletePost = document.querySelector('#deletePost');

if(fileImage){
    fileImage.addEventListener('change', function (event){
        let target = event.target;
        if(target.files[0] && target.files[0].type.includes('image')){
            showImage.src = URL.createObjectURL(target.files[0]);
            showImage.onload = function(){
                URL.revokeObjectURL(target.src);
            };
        }
    })
}


// if(deletePost){
//     deletePost.addEventListener('click', (e) =>{
//         let target = e.target
//     })
// }
