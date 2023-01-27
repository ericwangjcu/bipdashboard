function createcard(tasks,c){
    let cardContainer;
    
    let createTaskCard = (task) => {
    
    //<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
    let col = document.createElement('div');
    col.className = task.size;
    
    //<div class="card">
    let card = document.createElement('div');
    card.className = 'card flex-fill w-100';
    
    //<div class="card-body">
    let cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    
    //<div class="row">
    let col0 = document.createElement('div');
    col0.className = 'row';
    
    //<div class="col mt-0">
    let col1 = document.createElement('div');
    col1.className = 'col mt-0';
    
    //<h5 class="card-title">Number of Properties</h5>
    let title = document.createElement('h6');
    title.innerText = task.title;
    title.className = 'card-title';
    
    col1.appendChild(title);
    col0.appendChild(col1);
    
    //<h1 class="mt-2 mb-0">
    let col5 = document.createElement('h5');
    col5.className = 'mt-0 mb-0';
    col5.innerText = task.value;
    
    //<h5 class="mt-1 mb-0">
    let col6 = document.createElement('h6');
    col6.className = 'mt-0 mb-0';
    
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col7 = document.createElement('span');
    col7.className = 'text-success';
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col8 = document.createElement('i');
    col8.className = 'mdi mdi-arrow-bottom-right';
    col8.innerText = task.benchmark;
    //<span class="text-muted">BIP Total</span>
    let col9 = document.createElement('span');
    col9.className = 'text-muted';
    col9.innerText = task.text;
    
    col7.appendChild(col8);
    
    
    col6.appendChild(col7);
    col6.appendChild(col9);
    
    cardBody.appendChild(col0);
    cardBody.appendChild(col5);
    cardBody.appendChild(col6);
    card.appendChild(cardBody);
    col.appendChild(card);
    cardContainer.appendChild(col);
    
    }
    
    let initListOfTasks = () => {
   
    cardContainer = document.getElementById(c);
    
    createTaskCard(tasks);
    };
    
    initListOfTasks();
        
};

function createbenchmarkcard(tasks,c){
    let cardContainer;
    

    let createTaskCard = (task) => {
    
   
    //<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
    let col = document.createElement('div');
    col.className = task.size;
    
    //<div class="card">
    let card = document.createElement('div');
    card.className = 'card flex-fill w-100';
    
    //<div class="card-body">
    let cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    
    //<div class="row">
    let col0 = document.createElement('div');
    col0.className = 'row';
    
    //<div class="col mt-0">
    let col1 = document.createElement('div');
    col1.className = 'col-6';
    
    //<h5 class="card-title">Number of Properties</h5>
    let title = document.createElement('h5');
    title.innerText = task.title;
    title.className = 'card-title';
    
    col1.appendChild(title);
    
    
    //<h1 class="mt-2 mb-0">
    let col5 = document.createElement('h1');
    col5.className = 'mt-2 mb-1';
    col5.innerText = task.value;
    col5.id = task.id;

    col1.appendChild(col5);
    col0.appendChild(col1);
    
    //<div class="col-2" align="right">
    let col6 = document.createElement('div');
    col6.className = 'col-3';

    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col7 = document.createElement('span');
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col8 = document.createElement('i');
    col8.innerText = task.avr;
    let br = document.createElement("br");

    col7.appendChild(col8);
    col6.appendChild(col7);
    col6.appendChild(br);
    
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col7 = document.createElement('span');
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col8 = document.createElement('i');
    col8.innerText = task.min;
    br = document.createElement("br");
 
    col7.appendChild(col8);
    col6.appendChild(col7);
    col6.appendChild(br);

    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col7 = document.createElement('span');
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col8 = document.createElement('i');
    col8.innerText = task.max;
    
    col7.appendChild(col8);
    col6.appendChild(col7);

    //<div class="col-2" align="right">
    let col9 = document.createElement('div');
    col9.className = 'col-3'; 
 
    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'text-muted';
    col7.innerText = task.avrt;
    br = document.createElement("br");

    col9.appendChild(col7);
    col9.appendChild(br);

    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'text-muted';
    col7.innerText = task.mint;

    br = document.createElement("br");

    col9.appendChild(col7);
    col9.appendChild(br);

    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'text-muted';
    col7.innerText = task.maxt;

    col9.appendChild(col7);
    
    let chartcontainer = document.createElement('div');
    chartcontainer.id = task.idc;   
    chartcontainer.className = 'col-12'; 


    col0.appendChild(col6);     
    col0.appendChild(col9); 
    col0.appendChild(chartcontainer); 

    
    cardBody.appendChild(col0);
    card.appendChild(cardBody);
    col.appendChild(card);
    cardContainer.appendChild(col);
    }
    
    let initListOfTasks = () => {
    if (cardContainer) {
        document.getElementById(c).replaceWith(cardContainer);
        return;
    }
    
    cardContainer = document.getElementById(c);
    createTaskCard(tasks);
    };
    
    initListOfTasks();
        
};

function createbenchmarkcardnew(tasks,c){
    let cardContainer;
    

    let createTaskCard = (task) => {
    
   
    //<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
    let col = document.createElement('div');
    col.className = task.size;
    
    //<div class="card">
    let card = document.createElement('div');
    card.className = 'card flex-fill w-100';
    
    //<div class="card-body">
    let cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    
    //<div class="row">
    let col0 = document.createElement('div');
    col0.className = 'row';
    
    //<div class="col mt-0">
    let col1 = document.createElement('div');
    col1.className = 'col-6';
    
    //<h5 class="card-title">Number of Properties</h5>
    let title = document.createElement('h5');
    title.innerText = task.title;
    title.className = 'card-title';
    
    // col1.appendChild(title);
    
    
    //<h1 class="mt-2 mb-0">
    let col5 = document.createElement('h1');
    col5.className = 'mt-2 mb-1';
    col5.innerText = task.value;
    col5.id = task.id;

    // col1.appendChild(col5);
    // col0.appendChild(col1);
    
    //<div class="col-2" align="right">
    let col6 = document.createElement('div');
    col6.className = 'col-2';

    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col7 = document.createElement('span');
    col7.className = 'text-muted h3';
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col8 = document.createElement('i');
    col8.innerText = task.mint;
    let br = document.createElement("br");

    col7.appendChild(col8);
    col6.appendChild(col7);
    col6.appendChild(br);
    
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col7 = document.createElement('span');
    col7.className = 'text-muted h3';
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col8 = document.createElement('i');
    col8.innerText = task.maxt;
    br = document.createElement("br");
 
    col7.appendChild(col8);
    col6.appendChild(col7);
    col6.appendChild(br);

    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col7 = document.createElement('span');
    col7.className = 'text-muted h3';
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    col8 = document.createElement('i');
    col8.innerText = task.avrt;
    
    col7.appendChild(col8);
    col6.appendChild(col7);

    //<div class="col-2" align="right">
    let col9 = document.createElement('div');
    col9.className = 'col-2'; 
 
    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'h3';
    col7.innerText = task.min;
    br = document.createElement("br");

    col9.appendChild(col7);
    col9.appendChild(br);

    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'h3';
    col7.innerText = task.max;

    br = document.createElement("br");

    col9.appendChild(col7);
    col9.appendChild(br);

    //<span class="text-muted">BIP Total</span>
    col7 = document.createElement('span');
    col7.className = 'h3';
    col7.innerText = task.avr;

    col9.appendChild(col7);
    
    let chartcontainer = document.createElement('div');
    chartcontainer.id = task.idc;   
    chartcontainer.className = 'col-8'; 


    col0.appendChild(chartcontainer); 
    col0.appendChild(col6);     
    col0.appendChild(col9); 
    

    
    cardBody.appendChild(col0);
    // card.appendChild(cardBody);
    // col.appendChild(card);
    cardContainer.appendChild(col0);
    }
    
    let initListOfTasks = () => {
    if (cardContainer) {
        document.getElementById(c).replaceWith(cardContainer);
        return;
    }
    
    cardContainer = document.getElementById(c);
    createTaskCard(tasks);
    };
    
    initListOfTasks();
        
};

function createbar(tasks,c){
    let cardContainer;
    

    let createTaskCard = (task) => {
    
   
    //<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
    let col = document.createElement('div');
    col.className = task.size;
    
    //<div class="card">
    let card = document.createElement('div');
    card.className = 'card flex-fill w-100';
    
    //<div class="card-body">
    let cardBody = document.createElement('div');
    cardBody.className = 'card-body';


    let chartcontainer = document.createElement('div');
    chartcontainer.id = task.id;    
    
    cardBody.appendChild(chartcontainer);
    card.appendChild(cardBody);
    col.appendChild(card);
    cardContainer.appendChild(col);
    }
    
    let initListOfTasks = () => {
    if (cardContainer) {
        document.getElementById(c).replaceWith(cardContainer);
        return;
    }
    
    cardContainer = document.getElementById(c);
    createTaskCard(tasks);

    
    };
    
    initListOfTasks();
        
};

function creatediv(id){
    let newDiv  = document.createElement('div');
    newDiv .id = id;

    const newContent = document.createTextNode("Hi there and greetings!");

    newDiv.appendChild(newContent);


    const currentDiv = document.getElementById("div1");
    document.body.insertBefore(newDiv, currentDiv);   
}

