let pageIndex = 0;
let pageCount = 80;
let pageEntries = 20;
let pageChangeCallback = function(){};

function createPaginationFooter(container) {
    container.innerHTML = `<div class="pagination">
    <a href="#" id="pagePrevious">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#023b7e" viewBox="0 0 256 256">
            <path d="M168.49,199.51a12,12,0,0,1-17,17l-80-80a12,12,0,0,1,0-17l80-80a12,12,0,0,1,17,17L97,128Z"></path>
        </svg>
    </a>
    <a href="#" id="pageBegin">1</a>
    <p id="pageGapB">...</p>
    <a href="#" id="pageIdx1">4</a>
    <a href="#" id="pageIdx2">5</a>
    <a href="#" id="pageIdx3" class="active">6</a>
    <a href="#" id="pageIdx4">7</a>
    <a href="#" id="pageIdx5">8</a>
    <p id="pageGapE">...</p>
    <a href="#" id="pageEnd">25</a>
    <a href="#" id="pageNext"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#023b7e" viewBox="0 0 256 256">
            <path
                d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z">
            </path>
        </svg></a>
</div>`;
    
    // Setup Arrows events
    pagePrevious.onclick = function() {
        pageIndex = pageIndex-1;
        pageIndex = pageIndex<0? 0: pageIndex;
        pageChangeCallback(pageIndex-1);
    }
    pageNext.onclick = function() {
        pageIndex = pageIndex+1;
        pageIndex = pageIndex>=pageCount? pageCount-1: pageIndex;
        pageChangeCallback(pageIndex+1);
    }
    
    // Setup the page footer status
    changePage(pageIndex);
}

function changePage(index) {
    // Verify the page index
    if (index>=pageCount){
        throw new Error("Something is not right, index page crossed the limit.");
    }
    pageIndex = index;
    
    // Setup begin index
    pageBegin.textContent = '1';
    pageBegin.className = index==0? 'active': '';
    pageBegin.style.display = pageCount<=0? 'none': 'block';
    pagePrevious.style.display = index<=0? 'none': 'block';
    pageBegin.onclick = function(){
        pageIndex = 0;
        pageChangeCallback(0);
    }
    
    // Setup end index
    pageEnd.textContent = ''+pageCount;
    pageEnd.className = index==(pageCount-1)? 'active': '';
    pageEnd.style.display = pageCount<=1? 'none': 'block';
    pageNext.style.display = index>=(pageCount-1)? 'none': 'block';
    pageEnd.onclick = function(){
        pageIndex = pageCount-1;
        pageChangeCallback(pageCount-1);
    }
    
    // Clamp the middle indices and control the dots visibility
    let start = 1;
    if (index <= 3){
        start = 1;
    }
    else if (index >= (pageCount-4)){
        start = pageCount-6;
    }
    else {
        start = index-2;
    }
    pageGapB.style.display = start>1? 'block': 'none';
    pageGapE.style.display = start<(pageCount-6)? 'block': 'none';
    
    // Setup middle indices
    for (let i=0; i<5; i++){
        let el = document.getElementById('pageIdx'+(i+1));
        let idx = start+i;
        el.textContent = ''+(idx+1);
        el.style.display = idx>=(pageCount-1) || idx<=0? 'none': 'block';
        el.onclick = function(){
            pageIndex = idx;
            pageChangeCallback(idx);
        }
        el.className = index==idx? 'active': '';
    }
}
