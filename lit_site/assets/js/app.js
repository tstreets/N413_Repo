document.body.onload = (()=>
{
    addDetailListeners();
});

function addDetailListeners()
{
    const questsRef = document.querySelectorAll(".quest");
    
    questsRef.forEach(questRef=>
    {
        questRef.addEventListener("click", showMoreInfo);
    });
}

function showMoreInfo(e)
{
    if(this.dataset.open == "false")
    {
        e.preventDefault();
        
        const questsRef = document.querySelectorAll(".quest");
    
        questsRef.forEach(questRef=>
        {
            if(questRef.dataset.open == "true" && questRef != this)
            {
                questRef.open = false;
                questRef.dataset.open = "false";
            }
        });
        
        
        this.open = true;
        this.dataset.open = "true";
    }
}