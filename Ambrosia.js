//? Function to toggle div display
function HideDivId(DivId, DivStatus) {
    document.getElementById(DivId).style.display = DivStatus;
}

//? Function to toggle display of div by classes
function HideDiv(Type, Action){
    //! This function is used by the function UserFilter(). 
    //^ Type = div to be toggled, Action = display/hide
    //? The For-Loop is used because getElementsByClass returns an array
    for (let index = 0; index < Type.length; index++) {
        Type[index].style.display=Action;            
    }
}


//^ Search function
function SearchFunction(){

    var Query = document.getElementById("SearchBox").value.toLowerCase();
    var SearchPara = document.getElementsByClassName("HiddenInput");
   
    for (let index = 0; index < SearchPara.length; index++) {

        if (SearchPara[index].value.toLowerCase().indexOf(Query) !== -1) {
            
            SearchPara[index].parentElement.style.display="flex";
        } else if (SearchPara[index].value.toLowerCase().indexOf(Query) == -1) {
            
            SearchPara[index].parentElement.style.display="none";
        } 
        if (Query.length == 0) {
            SearchPara[index].parentElement.style.display="none";
        }
    }
}

function NoSearch() {//^ Hides the Search results
     var SearchResults = document.getElementsByClassName("HiddenInput");

        for (let index = 0; index < SearchResults.length; index++) {
            SearchResults[index].parentElement.style.display="none";                
        }
}

function SideMenu() { //^ Toggles the User/Admin navigation menu
    var SideMenu = document.getElementById("SideMenu");

    if (SideMenu.style.display=="none") {
        SideMenu.style.display="block";
    } else {
        SideMenu.style.display="none";
    }
}

/* function UserMenu() { //^ Toggles the User navigation menu
    var UserMenu = document.getElementById("UserMenu");
    if (UserMenu.style.display=="none") {
        UserMenu.style.display="block";
    } else {
        UserMenu.style.display="none";
    }
} */

function displayPassword() { //^ Login page, show password
    var Password = document.getElementById("Password");
    var showPass = document.getElementById("showPassword");
    if (showPass.checked == true) {
        Password.type="text";
    }else if (showPass.checked == false) {
        Password.type="password";
    }
}

function ForgotPass(state) { //^ Forgot Password 
    var UsernameDiv = document.getElementById("Forgot-Username");
    var SecurityDiv = document.getElementById("Forgot-Security");
    var PasswordDiv =  document.getElementById("Forgot-Password");

   switch(state) {
       case "Cancelled":
           HideDivId("Forgot-Username", "none");
           HideDivId("Forgot-Security", "none");
           HideDivId("Forgot-Password", "none");
           break;
        case "Initial": 
           HideDivId("Forgot-Username", "block");
           break;
        case "Identified": 
           HideDivId("Forgot-Username", "none");
           HideDivId("Forgot-Security", "block");
            break;
        case "Verified":
            HideDivId("Forgot-Security", "none");
            HideDivId("Forgot-Password", "block");
            break;
   }
}

function Theme(theme) { //^Toggles Dark Mode settings
    if (theme == "Dark") {
        HideDivId("LblDark", "none");
        HideDivId("LblLight", "block");
    }
    else if (theme == "Light") {
        HideDivId("LblDark", "block");
        HideDivId("LblLight", "none");
    }
}

function Subscription() { //^ Toggles the Newsletter Subsciption topics 
    var Subscription = document.getElementById("NewsletterSub");
    if (Subscription.checked == true) {
        document.getElementById("UpcomingClasses").removeAttribute("disabled");
        document.getElementById("NewRecipes").removeAttribute("disabled");
        document.getElementById("NewArticles").removeAttribute("disabled");
    }
    else {
        document.getElementById("UpcomingClasses").toggleAttribute("disabled");
        document.getElementById("NewRecipes").toggleAttribute("disabled");
        document.getElementById("NewArticles").toggleAttribute("disabled");
    }
}

function fillDate() { //^ Displays the current date for the posting of new articles/recipes
    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();

    if (day < 10) {
        day = "0" + day;
    } 
    if (month < 10) {
        month = "0" + month;
    } 
    var Dates = year + "-" + month + "-" + day;
    var PostDate = document.getElementById("Date");
    PostDate.value = Dates;
}

function PostTypeDisplay() { //^ Changes the layout for posting according to the type of post
    var Type = document.getElementById("PostType").value;
    var PostHeader = document.getElementById("PostHeader");
    var Tags = document.getElementsByClassName("RadioTags");

    if (Type == "Recipes") {
        PostHeader.innerText = "Recipe Steps";
        HideDiv(Tags, "none");
        HideDivId("IngLbl", "block");
        HideDivId("ArticleContent", "none");
        HideDivId("VidLbl", "none");
        HideDivId("RecipeContent", "block");
        HideDivId("RecipeSection", "block");
        HideDivId("ArticleSection", "none");
        HideDivId("SectionName", "block");
        HideDivId("TagsARLbl", "block");
        
    } else if (Type == "Articles") {
        PostHeader.innerText = "Article Content";
        HideDivId("ArticleContent", "block");
        HideDivId("ArticleSection", "block");
        HideDivId("SectionName", "block");
        HideDivId("TagsARLbl", "block");
        HideDivId("IngLbl", "none");
        HideDivId("RecipeContent", "none");
        HideDivId("VidLbl", "none");
        HideDivId("RecipeSection", "none");
        HideDiv(Tags, "none");
        
    } else if (Type == "Classes") {
        PostHeader.innerText = "Class Details";
        HideDivId("IngLbl", "block");
        HideDivId("VidLbl", "block");
        HideDivId("RecipeContent", "none");
        HideDivId("ArticleContent", "none");
        HideDiv(Tags, "block");
        HideDivId("RecipeSection", "none");
        HideDivId("ArticleSection", "none");
        HideDivId("SectionName", "none");
        HideDivId("TagsARLbl", "none");
    }
}

//^ Adds recipe ingredients to a List each time the (+) Button is clicked
function AddIngredient() { //TODO Validation for IName to prevent numbers from being entered
    var IItem = document.createElement("li");
    var AddBtn = document.getElementById("AddIngBtn");
    var IList = document.getElementById("IngredientList"); //^ Ingredient List Div

    var IName = document.getElementById("Ingredients"); //^ Name of Ingredients
    var INumber = document.getElementById("IngredientsNo"); //^ Quantity of Ingredients
    var IUnit = document.getElementById("IngredientsUnit").value; //^ Unit of Ingredients

    if (AddBtn.click) { 
        if (IName.value !== "" && INumber.value !== "") {
            //? Creates Ingredient Item (Name - Quantity Unit)
            var Ingredient = document.createTextNode(IName.value + " - " + INumber.value + IUnit); 
            IItem.appendChild(Ingredient);
            //? Adds the created Ingredient Item to the Ingredient List as a <li> element
            IList.appendChild(IItem); 

            //? Clear the text boxes
            IName.value = "";
            INumber.value = "";
        } else {
            alert("Please enter an ingredient and its quantity");
        }
        IName.focus();
    }
}

function deleteIngredient() { //^ Delete Ingredient item from Ingredient List
    var IDelete = confirm("Are you sure you want to delete this ingredient?");
    if (IDelete == true) {
        var IItem = event.target;
        var IList = IItem.parentNode;
        IList.removeChild(IItem);
    }    
}

function GetText(EditType) { //^ Passes data from list into hidden input. (@Admin Add/Edit Pages)

    if (EditType == "Recipes") {
        //? Passes the data from the Recipe Step box to the hidden input
    var Steps = document.getElementById("RecipeContent").innerHTML;
    document.getElementById("StepInput").value = Steps;

    //? Passes the data from the Recipe Ingredients box to the hidden input
    var Ingredient = document.getElementById("IngredientList").innerHTML;
    document.getElementById("IngInput").value = Ingredient;
    
    } else if (EditType == "Articles") {
        //? Passes the data from the Article Content box to the hidden input
        var Content = document.getElementById("ArticleContent").innerHTML;
        document.getElementById("ContentInput").value = Content;
        
    } else if (EditType == "Classes") {
        //? Passes the data from the Class ingredient box to the hidden input
        var ClassIng = document.getElementById("IngredientList").innerHTML;
        document.getElementById("ClassInput").value = ClassIng;
    }   
    else if (EditType == "Type") {
        //? Passes the data from the Class ingredient box to the hidden input
        var PostType = document.getElementById("PostType").value;
        document.getElementById("PostTypeHidden").value = PostType;
        document.getElementById("PostTypeAddHidden").value = PostType;
    }    
    else if (EditType == "All") { //? Add New - all 
        var Steps = document.getElementById("RecipeContent").innerHTML;
        document.getElementById("StepInput").value = Steps;

        var Ingredient = document.getElementById("IngredientList").innerHTML;
        document.getElementById("IngInput").value = Ingredient;

        var Content = document.getElementById("ArticleContent").innerHTML;
        document.getElementById("ContentInput").value = Content;
    }
}

function AddSection(Button, AppendDivId) {
 //^ Adds Section heading in the Article/Recipe Content/Ingredients section
    var Section = document.createElement("h4");
    var SectionName = document.getElementById("SectionName");
    var Content = document.getElementById(AppendDivId);
    var List = document.createElement("li");

    if (Button == "IngSection") {
        SectionName = document.getElementById("IngSectionName");
        var CreateIngSection = document.createTextNode(SectionName.value);
        Section.appendChild(CreateIngSection);
        Content.appendChild(Section);
        SectionName.value = "";
        return;
    } else if (Button == "EditRecipeStep" || Button == "ArticleSectionEdit") {
        SectionName = document.getElementById("SectionNameEdit");    
    } 
    
    var CreateSection = document.createTextNode(SectionName.value);
    Section.appendChild(CreateSection);
    Content.appendChild(Section);
    SectionName.value = "";

    Content.appendChild(List);
    Content.focus();
}

function CheckRadio(TagName, TypeVal){//^ Auto selects radio button (Class - Tag) upon loading edit page
document.getElementById(TagName).checked = "checked";
document.getElementById(TypeVal).checked = "checked";
}

function SelectTag(TagName) { //^ Auto selects <Select> element choice at (Article/Recipe - Tags)
    document.getElementById(TagName).selected = "selected";
}

function Bookmarks(condition) { //^ Informs user about Bookmark status by changing Bookmark icon colour
    if (condition == "Invalid") {
        alert("Please log in to bookmark this post!"); 
    } else if (condition == "Created") {
        document.getElementById("BookmarkIcon").style.color = "#F46D90";
    } else if (condition == "Deleted") {
        document.getElementById("BookmarkIcon").style.color = "black";
    } 
}

function Confirmation(Type, UserID) { //^ to double check intentions to delete User/Admin/Post/Tag/Payment
  switch (Type) {
        case "Users":
            var Msg = "Do you really want to delete User ";
            break;
        case "Refund":
            var Msg = "Do you want to refund payment numbered ";
            break;
        case "Post":
            var Msg = "Do you really want to delete this post: ";
            break;
        case "Admin":
            var Msg = "Do you really want to delete this Admin: ";
            break;
        case "Tag":
            var Msg = "Do you really want to delete this tag: ";
            break;
  } 
    var Check = confirm(Msg + UserID + "?");
    if (Check == true) {
        this.submit();
    }
}

function CheckTable(Name){
  //? Checks if the Tag Manager table contains a duplicate entry
    var TblRow = document.getElementsByClassName("Name");
    for (let index = 0; index < TblRow.length; index++) {
                 
        //? If a row is found with the same name, the function exits and returns the value of False
            if (TblRow[index].innerText.toLowerCase().includes(Name) == true) {
                alert("This is a duplicate entry!");
                return true;
            } 
        } //? Else, the function returns with the value of true
        return false;
}

function AdminSubmit() { //^ Collects data and submits the form to create a new Admin
   var AdminUsername = prompt("Username for Admins must contain the word Admin", "Admin");

    if (CheckTable(AdminUsername) == false) {

    if (AdminUsername.includes("admin") == true || AdminUsername.includes("Admin") === true) {
            var AdminPass = prompt("Enter your password");
            } else {
                alert("Your username must contain the word admin!");
                return;
            }

        document.getElementById("HiddenUsername").value = AdminUsername;
        document.getElementById("HiddenPassword").value = AdminPass;
        if (AdminPass == null || AdminPass == "") {
            alert("Invalid password. Operation has been cancelled");
            return;
        } else {
          document.getElementById("AddAdmin").submit();
        }
    }
}

function TagSubmit() { //^ Collects data and submits the form to create a new tag
    var TagName = prompt("Tag Name");
 
    document.getElementById("HiddenTag").value = TagName;
    
    if (CheckTable(TagName.toLowerCase()) == false) {
        document.getElementById("AddTag").submit();
    }
   
 }

function HideTblRow(Type, Action){ //^ Hides Table Rows
    //? Type = Type of Post to be filtered, Action = "none/show"

    var TblRow = document.getElementsByClassName("PostType");

    for (let index = 0; index < TblRow.length; index++) {
            if (TblRow[index].innerText.includes(Type)) {
                TblRow[index].parentNode.style.display=Action;
            } 
        }
}

function FilterManager(){
    //^ Filter function for the Admin - Post Manager.php page

    var FilterValue = document.getElementById("PostFilter").value;
 
    switch (FilterValue) {
        case "Recipes":
            HideTblRow("Recipe", "");
            HideTblRow("Article", "none");
            HideTblRow("Class", "none");
            break;
        case "Articles":
            HideTblRow("Recipe", "none");
            HideTblRow("Article", "");
            HideTblRow("Class", "none");
            break;
        case "Classes":
            HideTblRow("Recipe", "none");
            HideTblRow("Article", "none");
            HideTblRow("Class", "");
            break;
        case "All":
            HideTblRow("Recipe", "");
            HideTblRow("Article", "");
            HideTblRow("Class", "");
            break;
    }  
}

function UserFilter(FilterID) { 
    //^ Filters bookmarks depending on selected option
    var FilterVal = document.getElementById(FilterID).value;

    //? Gets the respective divs
    var Article = document.getElementsByClassName("BookmarkA");
    var Recipe_Class = document.getElementsByClassName("BookmarkR");
    
    switch (FilterVal) {
        //? The switch statement checks the value of the Filter and toggles the view accordingly
        case "Articles":
            HideDiv(Recipe_Class, "none");
            HideDiv(Article, "block");
            break;

        case "Recipes":
           HideDiv(Recipe_Class,"block");
           HideDiv(Article,"none");
            break;

        case "All":
            HideDiv(Recipe_Class,"block");
            HideDiv(Article,"block");
            HideDiv(Dessert, "block");
            break;
    }
}

function HideClassItem(item) { //^ Used with UserClassFilter()
    //? Hides all tag items
    var Class = document.getElementsByClassName(item);
    HideDiv(Class, "none");
}
function ShowClassItem(item) {//^ Used with UserClassFilter()
    //? Shows all tag items
    var Class = document.getElementsByClassName(item);
    HideDiv(Class, "block");
}
function UserClassFilter(TagArray) { //^ Filters User purchased classes according to vy tag
    var Filter = document.getElementById("ClassFilter").value;
    var Array = TagArray.split(",");
 
    Array.forEach(HideClassItem); //? Hides all initially

    var ClassDiv = document.getElementsByClassName(Filter); 
    HideDiv(ClassDiv, "block"); //? Displays the class depending on selected tag

    if (Filter == "All") { //? Shows all classes if All filter was selected
        Array.forEach(ShowClassItem);
    }
}

function PayConfirm(Status) {//^ Checks that all payment details have been filled before proceeding

    var CardDetail = document.getElementsByClassName("PayBox").value;
    var CardEx = document.getElementById("CardExpiry").value;
    var CVV = document.getElementById("CVV").value;
    var RadioVisa = document.getElementById("PayMethodV");
    var RadioMasters = document.getElementById("PayMethodM");

    //? If Pay was pressed and all details have been filled: toggle the Confirm Payment screen
    if (Status == "Confirm" && CardDetail !== "" && CardEx !== "" && CVV !== "" && (RadioVisa.checked || RadioMasters.checked)) {
        
        document.getElementById("PayHead").style.display = "none";
        document.getElementById("PayDetails").style.display="none";
        document.getElementById("PayBtn").style.display="none";
        document.getElementById("ConfirmPay").style.display="block";
        document.getElementById("ConfirmDiv").style.display="flex";
    } else if (Status == "Cancel") {
        // ? Toggles the Payment screen
        document.getElementById("PayHead").style.display = "block";
        document.getElementById("PayDetails").style.display="block";
        document.getElementById("PayBtn").style.display="";
        document.getElementById("ConfirmPay").style.display="none";
        document.getElementById("ConfirmDiv").style.display="none";
    } else { //? Warning Message if details are not filled
        alert("Please fill in your credit card details");
    }
}