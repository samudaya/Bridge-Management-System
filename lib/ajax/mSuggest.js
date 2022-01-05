
var mSuggest = new Class({

  options: {
    InputBox: false,
    SuggestArray: [],
    MaxDisplay: 5,
    EffectDuration: 500,
    SuggestItem: 0
  },
  
  initialize: function(options){
    // Initialize variables
    this.setOptions(options);
    this.InputBox = this.options.InputBox;
    this.InputBoxProperties = [];
    this.SuggestionBox = null;
    this.RelativeArray = [];
    this.SuggestArray = [];
    this.MaxDisplay = this.options.MaxDisplay;
    this.EffectDuration = this.options.EffectDuration;
    this.SuggestItem = this.options.SuggestItem;
    this.ToggleFX = null;
    this.IsOpen = false;
    this.HasEntered = false;
    this.ListPos = null;
    this.ChosenItem = null;
    this.IndexBase = 0;
    this.MyPos = 1;
    
    // Perform key initialization functions
    this.AddSuggestions(this.options.SuggestArray);
    this.GetInputBoxProperties(this.InputBox);
    this.CreateSuggestionBox();
    this.AddInputEvents();
  },
  
  AddSuggestions: function(suggestions){
    suggestions.each(function(suggestion){
      this.SuggestArray.extend([suggestion]);
    }, this);
  },
  
  GetInputBoxProperties: function(){
    this.InputBoxProperties = this.InputBox.getCoordinates();
  },
  
  CreateSuggestionBox: function(){
    // Create new element
    this.SuggestionBox = new Element('div', {
      'class': 'suggestions',
      'events': {
        'mouseenter': function(){
          this.HasEntered = true;
        }.bind(this),
        'mouseleave': function(){
          this.HasEntered = false;
          this.BeginFade();
        }.bind(this)
      }
    });
    
    // Set its properties
    this.SuggestionBox.setStyle('display', 'block');
    this.SuggestionBox.setStyle('width', (this.InputBoxProperties['width']-2));
    this.SuggestionBox.setStyle('top', (this.InputBoxProperties['top']+this.InputBoxProperties['height']+12));
    this.SuggestionBox.setStyle('left', (this.InputBoxProperties['left']+2));

    this.SuggestionBox.injectInside(document.body);
    this.ToggleFX = new Fx.Style(this.SuggestionBox, 'opacity', {duration: this.EffectDuration});
  },
  
  AddInputEvents: function(){
    this.InputBox.addEvents({
      'keyup': function(event){
        event = new Event(event);

        if(event.key == "up")
        {
          if(this.RelativeArray.length > 0) this.UpList(this.RelativeArray);
        } else if(event.key == "down"){
          if(this.RelativeArray.length > 0) this.DownList(this.RelativeArray);
        } else if(event.key == "enter"){
          if(this.RelativeArray.length > 0 && this.ChosenItem != null && this.IsOpen == true)
          {
            this.InputBox.value = this.ChosenItem;
            this.HideSuggestions();
          }
        } else {
          this.ListPos = null;
          this.MyPos = 1;
          this.Indexbase = 0;
          this.PerformSuggest();
        }
      }.bind(this),
      'mouseleave': function(){
        this.HasEntered = false;
        this.BeginFade();
      }.bind(this)
    });
  },
  
  HighlightItem: function(){
    $('s' + this.SuggestItem + this.ListPos).addClass('mouseenter');
    this.ChosenItem = this.RelativeArray[this.ListPos];

    if(this.IsOpen == false && this.RelativeArray.length > 0) 
    {
      this.EmptySuggestions();
      this.InjectSuggestions(this.RelativeArray, this.IndexBase);
      this.ShowCount(this.RelativeArray, this.ListPos);
      this.ShowSuggestions();
    }
  },
  
  DownList: function(){
    // Am i null? If so, make me 0. If not, add to me.
    if(this.ListPos == null)
    {
      this.ListPos = 0;
    } else {
      this.ListPos++;
      this.MyPos++;
    }

    // Am i greater than allowed and myPos equal to max display? If so, reset me and my base and my pos.
    if(this.ListPos > (this.RelativeArray.length-1) && this.MyPos > this.MaxDisplay || this.ListPos > (this.RelativeArray.length-1) && this.MyPos > (this.RelativeArray.length-1))
    {
      this.ListPos = 0;
      this.IndexBase = 0;
      this.MyPos = 1;
    } else if(this.MyPos > this.MaxDisplay && this.ListPos <= (this.RelativeArray.length-1)){
      this.IndexBase++;
      this.MyPos = this.MaxDisplay
    }

    // Show the results and highlight
    if(this.IsOpen == true && this.RelativeArray.length > 0) 
    {
      this.EmptySuggestions();
      this.InjectSuggestions(this.RelativeArray, this.IndexBase);
      this.ShowCount(this.RelativeArray, this.ListPos);
    }

      this.HighlightItem(this.RelativeArray, this.ListPos);
  },

  UpList: function(){
    // Am i null? If so, make me equal to biggest. If not, take from me.
    if(this.ListPos == null)
    {
      this.ListPos = (this.RelativeArray.length-1);
    } else {
      this.ListPos--;
      this.MyPos--;
    }

    // Am i smaller than allowed? If so, reset me and my base.
    if(this.ListPos < 0 && this.MyPos < 1 || this.ListPos < 0)
    {
      this.ListPos = (this.RelativeArray.length-1);
      this.IndexBase = (this.RelativeArray.length-1)-(this.MaxDisplay-1);
      this.MyPos = this.MaxDisplay;
      if(this.MaxDisplay > (this.RelativeArray.length-1)) this.MyPos = (this.MaxDisplay - (this.RelativeArray.length-1));
    }else if(this.MyPos < 1 && this.ListPos <= (this.RelativeArray.length-1)){
      this.IndexBase--;
      this.MyPos = 1;
    }

    // Show the results and highlight
    if(this.IsOpen == true && this.RelativeArray.length > 0) 
    {
      this.EmptySuggestions();
      this.InjectSuggestions(this.RelativeArray, this.IndexBase);
      this.ShowCount(this.RelativeArray, this.ListPos);
    }

    this.HighlightItem(this.RelativeArray, this.ListPos);
  },

  InjectItem: function(item, index){
    // Create a new element
    var newElement = new Element('div', {
      'id': 's' + this.SuggestItem + index,
      'class': 'suggestionentry',
      'events': {
        'click': function(){
          // Select item and close suggestion box
          this.SelectItem(item);
          this.HideSuggestions()
        }.bind(this),
        'mouseenter': function(){
          newElement.removeClass('mouseleave');
          newElement.addClass('mouseenter');
        }.bind(this),
        'mouseleave': function(){
          newElement.removeClass('mouseenter');
          newElement.addClass('mouseleave');
        }.bind(this)
      }
    }).setHTML(item);

    // Inject new element into the suggestions box
    newElement.injectInside(this.SuggestionBox);
  },

  InjectSuggestions: function(){
    var iCount = 0;
    this.RelativeArray.each(function(item, index){
      if(iCount < this.MaxDisplay && index >= this.IndexBase)
      {
        this.InjectItem(item, index);
        iCount++;
      }
    }, this);
  },

  SelectItem: function(item){
    this.InputBox.value = item;
  },


  DoFade: function(){
    if(this.IsOpen == true && this.HasEntered == false)
    {
      this.HideSuggestions();
    }
  },

  BeginFade: function(){
    if(this.IsOpen == true)
    {
      this.DoFade.bind(this).delay(500);
    }
  },

  ShowCount: function(){
    var newElement = new Element('div', {
      'class': 'suggestioncount'
    }).setHTML((this.ListPos+1) + '/' + this.RelativeArray.length + ' suggestions');

    // Inject new element into the suggestions box
    newElement.injectInside(this.SuggestionBox);
  },

  CloseSuggestions: function(){
    this.IsOpen = false;
    this.ToggleFX.set(0);
  },

  HideSuggestions: function(){
    this.ListPos = null;
    this.MyPos = 1;
    this.Indexbase = 0;
    this.IsOpen = false;
    this.ToggleFX.start(1, 0);
  },

  ShowSuggestions: function(){
    this.IsOpen = true;
    this.ToggleFX.start(0, 1);
  },

  EmptySuggestions: function(){
    this.SuggestionBox.setHTML('');
  },

  PerformSuggest: function(){
    // Empty relative suggestions
    this.RelativeArray.length = 0;
  
    // Has the user typed anything?!
    if(this.InputBox.value != '')
    {
  
      // Reset ListPos, MyPos and IndexBase
      this.ListPos = null;
      this.MyPos = 1;
      this.Indexbase = 0;
  
      // Fill relative suggestions array
      this.SuggestArray.each(function(item, index){
  
        if(item.test("^"+this.InputBox.value, "i"))
        {
          // Extend matched array if item isn't exact
          if(item != this.InputBox.value) this.RelativeArray.extend([item]);
        }
  
      }, this);
  
      // Did anything match? Then show it!
      if(this.IsOpen == false && this.RelativeArray.length > 0) 
      {
        this.EmptySuggestions();
        this.InjectSuggestions(this.RelativeArray, this.IndexBase);
        this.ShowCount(this.RelativeArray, this.ListPos);
        this.ShowSuggestions();
      } else if(this.IsOpen == true && this.RelativeArray.length > 0){
        this.EmptySuggestions();
        this.InjectSuggestions(this.RelativeArray, this.IndexBase);
        this.ShowCount(this.RelativeArray, this.ListPos);
      } else if(this.IsOpen == true && this.RelativeArray.length == 0){
        this.HideSuggestions();
      }
  
    } else {
      this.CloseSuggestions();
    }
  }
  
});

/* ******************************************************************************** */

mSuggest.implement(new Options, new Events);

/* ******************************************************************************** */

window.addEvent('domready', function(){
  var suggestArray = [];
  var iCount = 0;
  suggestionobjects = $$('input[rel=Suggest]');
  suggestionobjects.each(function(txt){
    suggestArray.extend([
      new mSuggest({
        InputBox: txt,
        SuggestArray: txt.getProperty('data').split(','),
        MaxDisplay: 8,
        EffectDuration: 500,
        SuggestItem: iCount
      })
    ]);
    iCount++;
  });
});