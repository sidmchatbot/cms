(function(){
    const _ = function(e){
        return document.querySelectorAll(e);
    }
    async function f(e){
        const fd = new FormData(e),
        {method} = e;
        fd.append("type", e.querySelector(".click").value);
        ul("l", e);
        return fetch(e.action, {
            method : method,
            body : fd
        }).then(res=>{
            ul("u", e);
            e.querySelector(".click").classList.remove("click");
            return res.json();
        });

    }
    function ul(m, e){
        for(let i = 0; i < e.length; i++){
            switch(m){
                case "l" : 
                        e[i].disabled = true;
                break;
                case "u" : 
                    e[i].disabled = false;
                break;
            }
        }
    }
    async function s(e, c){
        e.preventDefault();
        const d = await f(this);
        
        if(c){
            c.call(this, d);    
        }

        return d;
    }
    async function w(){
        this.classList.add("click");
    }
    async function a(e){
        e.querySelectorAll("input[type=submit]").forEach(e=>e.onclick = w);
    }
    function ca(){
        let p = this,c;
        
        while(p = p.parentElement){
            c = p.querySelectorAll(".course");
            if(c.length == 1){continue;}
            else{break;}
        }
        
        if(this.name == "course")
        if(this.checked){
            c.forEach(e=>e.checked = true);
        }
        else{
            c.forEach(e=>e.checked = false);
        }
        else{
            let t = 0;
            c.forEach(e=>t+= e.checked ? 1 : 0);
            if(!this.checked){
                t++;
            }
            if(c.length-1 == t){ 
                p.querySelector(".course[name='course']").checked = true;
            }
            else{
                p.querySelector(".course[name='course']").checked = false;
            }
        }
    }
    function dc(){
        let c = _(".courses input[type='checkbox']:not([name='course']):checked"),
        fd = new FormData(),
        i = 0;
        if(c.length == 0)return;
        if(!confirm(`Delete ${c.length} course(s)?`))return;
        for(; i < c.length; i++){
            fd.append("course["+i+"]", c[i].name.replace(/(course|\[|\])/g,""));
            fd.append(`course_name[${i}]`,c[i].parentElement.nextElementSibling.innerText);
        }
        fetch("process.php?type=delete", {method : "POST", body : fd})
        .then(e=>e.json())
        .then(e=>c.forEach(e=>{
            let a = e;
            while((a=a.parentElement) && !a.classList.contains("data"));
            a.remove();
        }));
    }
    window.onload = ()=>{
        $("#tokenfield").tokenfield().on("tokenfield:createdtoken", function(e){
            let a = [...new Set($.map($(this).parent().children(".token"), function(e){
                return $(e).data("value");
            }))];
            $("#all-tokens").val(a.join(","));
        });
        _("label > input[type='checkbox']").forEach(e=>{e.onclick=ca;});
        _("input[value='Delete']").forEach(e=>e.onclick = dc);
        _("form[data-prevent='true']").forEach(e=>{a(e); e.onsubmit=s;});
    }
    this.NYP = {
        send : s,
        ca : ca
    }
})();