/*
 * Noteit
 * Evernote
 * $Rev: 109850 $
 *
 * Created by Pavel Skaldin on 7/13/10
 * Copyright 2010 Evernote Corp. All rights reserved.
 */
var Evernote = (typeof Evernote == 'object' && Evernote != null) ? Evernote
    : {};
Evernote.logger = {
  debug : function(msg) {
    if (typeof console == 'object' && console != null
        && typeof console["log"] == 'function') {
      console.log(msg);
    }
  },
  isDebugEnabled : function() {
    return false;
  }
};
Evernote.detectCharacterEncoding = function(doc) {
  var d = (doc) ? doc : document;
  var cs = null;
  if (typeof d.characterSet == 'string') {
    cs = d.characterSet;
  } else if (typeof d.charset == 'string') {
    cs = d.charset;
  } else if (typeof d.inputEncoding == 'string') {
    cs = d.inputEncoding;
  } else if (typeof d.defaultCharset == 'string') {
    cs = d.defaultCharset;
  }
  return cs;
};
/** ************** Duck punching *************** */
if (typeof Array.prototype.indexOf != 'function') {
  Array.prototype.indexOf = function(o) {
    for (var i=0; i<this.length; i++) {
      if (this[i] == o) {
        return i;
      }
    }
    return -1;
  };
}
/** ************** Config *************** */
Evernote.Config = {
  insecureProto : "http://",
  secureProto : "https://",
  serviceDomain : "www.evernote.com",
  clipPath : "/noteit.action",
  getClipUrl : function() {
    return this.secureProto + this.serviceDomain + this.clipPath;
  }
};
/** ************** Inheritance *************** */
Evernote.inherit = function(childConstructor, parentClassOrObject,
    includeConstructorDefs) {
  if (parentClassOrObject.constructor == Function) {
    // Normal Inheritance
    childConstructor.prototype = new parentClassOrObject;
    childConstructor.prototype.constructor = childConstructor;
    childConstructor.prototype.parent = parentClassOrObject.prototype;
    childConstructor.constructor.parent = parentClassOrObject;
  } else {
    // Pure Virtual Inheritance
    childConstructor.prototype = parentClassOrObject;
    childConstructor.prototype.constructor = childConstructor;
    childConstructor.prototype.parent = parentClassOrObject;
    childConstructor.constructor.parent = parentClassOrObject;
  }
  if (includeConstructorDefs) {
    for ( var i in parentClassOrObject.prototype.constructor) {
      if (i != "parent"
          && i != "prototype"
          && parentClassOrObject.constructor[i] != parentClassOrObject.prototype.constructor[i]
          && typeof childConstructor.prototype.constructor[i] == 'undefined') {
        childConstructor.prototype.constructor[i] = parentClassOrObject.prototype.constructor[i];
      }
    }
  }
  if (typeof childConstructor.handleInheritance == 'function') {
    childConstructor.handleInheritance.apply(childConstructor, arguments);
  }
  return childConstructor;
};
Evernote.inherits = function(childConstructor, parentClass) {
  return (typeof childConstructor.prototype.parent != 'undefined' && childConstructor.prototype.parent.constructor == parentClass);
};

/** ************** Utility Methods *************** */
Evernote.isHtmlElement = function(element) {
  if (typeof HTMLElement == 'function') {
    return (element instanceof HTMLElement);
  } else if (typeof Element == 'function') {
    return (element instanceof Element);
  } else if (element != null) {
    // really trying our luck
    return (typeof element["nodeType"] != "undefined" && element["nodeType"] == 1);
  }
  return false;
};
Evernote.trimString = function(str) {
  if (typeof str == 'string') {
    return str.replace(/^\s+/, "").replace(/\s+$/, "");
  }
  return str;
};
Evernote.collapseString = function(str) {
  if (typeof str == 'string') {
    return str.replace(/[\s\t\n]+/g, " ").replace(/^\s+/, "").replace(/\s+$/,
        "");
  }
  return str;
};
Evernote.cleanArray = function(array, fn) {
  if (array instanceof Array && typeof fn == 'function') {
    var i = 0;
    while (i < array.length) {
      if (fn(array[i])) {
        array.splice(i, 1);
      } else {
        i += 1;
      }
    }
  }
};
Evernote.findChildren = function(anchor, fn, recursive) {
  var children = new Array();
  if (typeof anchor == 'object' && anchor != null
      && typeof anchor["nodeType"] == 'number' && anchor.nodeType == 1) {
    var childNodes = anchor.childNodes;
    for ( var i = 0; i < childNodes.length; i++) {
      if (typeof fn == 'function' && fn(childNodes[i])) {
        children.push(childNodes[i]);
      } else if (typeof fn != 'function') {
        children.push(childNodes[i]);
      }
      if (recursive && childNodes[i].childElementCount > 0) {
        var otherChildren = arguments.callee(childNodes[i], fn);
        if (otherChildren && otherChildren.length > 0) {
          children = Evernote.concatArrays(children, otherChildren);
        }
      }
    }
  }
  return children;
};
Evernote.findParent = function(anchor, fn) {
  if (typeof anchor == 'object' && anchor != null
      && typeof anchor["nodeType"] == 'number') {
    if (anchor.nodeName == "BODY") {
      return anchor;
    } else if (anchor.parentNode == "BODY") {
      return anchor;
    } else {
      var p = anchor;
      while (p.parentNode.nodeName != "BODY") {
        if (typeof fn == 'function' && fn(p.parentNode)) {
          return p.parentNode;
        } else if (typeof fn != 'function') {
          return p.parentNode;
        }
        p = p.parentNode;
      }
    }
  }
  return null;
};
Evernote.hasElementClass = function(element, className, caseSensitive) {
  if (!this.isHtmlElement(element))
    return false;
  try {
    var classAttr = element.getAttribute("class");
    if (typeof classAttr != 'string')
      return false;
    if (!caseSensitive) {
      classAttr = classAttr.toLowerCase();
      className = className.toLowerCase();
    }
    var classNames = classAttr.replace(/\s+/, " ").split(" ");
    return classNames.indexOf(className) >= 0;
  } catch (e) {
  }
  return false;
};
Evernote.containsElementClass = function(element, className, caseSensitive) {
  if (!this.isHtmlElement(element))
    return false;
  try {
    var classAttr = element.getAttribute("class");
    if (typeof classAttr != 'string')
      return false;
    if (!caseSensitive) {
      classAttr = classAttr.toLowerCase();
      className = className.toLowerCase();
    }
    return classAttr.indexOf(className) >= 0;
  } catch (e) {
  }
  return false;
};
Evernote.hasElementId = function(element, id, caseSensitive) {
  if (!this.isHtmlElement(element))
    return false;
  try {
    var idAttr = element.getAttribute("id");
    if (typeof idAttr != 'string')
      return false;
    if (!caseSensitive) {
      idAttr = idAttr.toLowerCase();
      id = id.toLowerCase();
    }
    return idAttr == id;
  } catch (e) {
  }
  return false;
};
Evernote.containsElementId = function(element, id, caseSensitive) {
  if (!this.isHtmlElement(element))
    return false;
  try {
    var idAttr = element.getAttribute("id");
    if (typeof idAttr != 'string')
      return false;
    if (!caseSensitive) {
      idAttr = idAttr.toLowerCase();
      id = id.toLowerCase();
    }
    return idAttr.indexOf(id) >= 0;
  } catch (e) {
  }
  return false;
};
Evernote.isElementVisible = function(element) {
  if (!this.isHtmlElement(element))
    return false;
  try {
    var style = element.ownerDocument.defaultView.getComputedStyle(element);
    if (style) {
      if (style.getPropertyValue("display") != "none"
          && style.getPropertyValue("visibility") != "none") {
        return true;
      }
    }
  } catch (e) {
  }
  return false;
};
Evernote.getElementClassNames = function(element) {
  if (!this.isHtmlElement(element))
    return false;
  return element.getAttribute("class").replace(/\s+/, " ").split(" ");
};
Evernote.getElementSortedClassName = function(element) {
  if (!this.isHtmlElement(element))
    return null;
  return Evernote.getElementClassNames().sort().join(" ");
};
/** ************** Clip *************** */
Evernote.Clip = function(aWindow, stylingStrategy) {
  this.initialize(aWindow, stylingStrategy);
};

Evernote.Clip.constants = {
  isIE : (navigator.appVersion.indexOf("MSIE", 0) != -1),
  isSafari : (navigator.appVersion.indexOf("WebKit", 0) != -1),
  isFirefox : (navigator.userAgent.indexOf("Firefox", 0) != -1),
  isIpad : (navigator.userAgent.indexOf("WebKit") > 0 && navigator.userAgent
      .indexOf("iPad") > 0),
  isIphone : (navigator.userAgent.indexOf("WebKit") > 0 && navigator.userAgent
      .indexOf("iPhone") > 0)
};

Evernote.Clip.contentMarkers = [ "article", "post", "content", "story", "body" ];
Evernote.Clip.filterMarkers = [ "comment", "feedback", "breadcrumb", "share",
    "sharing", "social", "sociable", "tools", "links", "extra", "related",
    "sponsor", "ads", "adsense", "banner", "chat", "shout", "module" ];

Evernote.Clip.NOKEEP_NODE_ATTRIBUTES = {
  "style" : null,
  "class" : null,
  "id" : null,
  "onclick" : null,
  "onsubmit" : null,
  "onmouseover" : null,
  "onmouseout" : null
};
Evernote.Clip.NOKEEP_NODE_NAMES = {
  "style" : null,
  "script" : null,
  "input" : null,
  "select" : null,
  "option" : null,
  "textarea" : null
};
Evernote.Clip.SELF_CLOSING_NODE_NAMES = {
  "base" : null,
  "basefont" : null,
  "frame" : null,
  "link" : null,
  "meta" : null,
  "area" : null,
  "br" : null,
  "col" : null,
  "hr" : null,
  "img" : null,
  "input" : null,
  "param" : null
};
Evernote.Clip.NODE_NAME_TRANSLATIONS = {
  "body" : "div",
  "form" : "div"
};
Evernote.Clip.LIST_NODE_NAMES = {
  "ul" : null,
  "ol" : null
};
Evernote.Clip.HTMLEncode = function(str) {
  var result = "";
  for ( var i = 0; i < str.length; i++) {
    var charcode = str.charCodeAt(i);
    var aChar = str[i];
    if (charcode > 0x7f) {
      result += "&#" + charcode + ";";
    } else if (aChar == '>') {
      result += "&gt;";
    } else if (aChar == '<') {
      result += "&lt;";
    } else if (aChar == '&') {
      result += "&amp;";
    } else {
      result += str.charAt(i);
    }
  }
  return result;
};
Evernote.Clip.unicodeEntities = function(str) {
  var result = "";
  if (typeof str == 'string') {
    for ( var i = 0; i < str.length; i++) {
      var c = str.charCodeAt(i);
      if (c > 127) {
        result += "&#" + c + ";";
      } else {
        result += str.charAt(i);
      }
    }
  }
  return result;
};

Evernote.Clip.isHtmlElement = function(element) {
  return Evernote.isHtmlElement(element);
};
Evernote.Clip.trimString = function(str) {
  return Evernote.trimString(str);
};
Evernote.Clip.collapseString = function(str) {
  return Evernote.collapseString(str);
};
/**
 * When serializing DOM elements, this attribute is checked to see if it's a
 * function. If it is, it's passed currently serialized element. If the function
 * returns a truthful result, the element will be serialized, otherwise - it
 * will be excluded/skipped. This is meant to globally define the behavior and
 * is called from Evernote.Clip.prototype.nodeFilter by default.
 *
 * For custom filtering logic on per-object basis - override
 * Evernote.Clip.prototype.nodeFilter; for all instanceof of Evernote.Clip - you
 * override Evernote.Clip.nodeFilter.
 */
Evernote.Clip.nodeFilter = null;

Evernote.Clip.prototype.title = null;
Evernote.Clip.prototype.location = null;
Evernote.Clip.prototype.window = null;
Evernote.Clip.prototype.selectionFinder = null;
Evernote.Clip.prototype.deep = true;
Evernote.Clip.prototype.content = null;
Evernote.Clip.prototype.range = null;
Evernote.Clip.prototype._stylingStrategy = null;
Evernote.Clip.prototype._verboseLog = false;

// Declares the content and source of a web clip
Evernote.Clip.prototype.initialize = function(aWindow, stylingStrategy) {
  this.title = (typeof aWindow.document.title == 'string') ? aWindow.document.title
      : "";
  this.title = Evernote.Clip.collapseString(this.title);
  this.location = aWindow.location;
  this.window = aWindow;
  this.selectionFinder = new Evernote.SelectionFinder(aWindow.document);
  this.range = null;
  if (stylingStrategy) {
    this.setStylingStrategy(stylingStrategy);
  }
};

Evernote.Clip.prototype.isFullPage = function() {
  return !this.hasSelection();
};

Evernote.Clip.prototype.hasSelection = function() {
  if (this.selectionFinder.hasSelection()) {
    return true;
  } else {
    this.findSelection();
    return this.selectionFinder.hasSelection();
  }
};
Evernote.Clip.prototype.findSelection = function() {
  this.selectionFinder.find(this.deep);
};
Evernote.Clip.prototype.getSelection = function() {
  if (this.hasSelection()) {
    return this.selectionFinder.selection;
  }
  return null;
};
Evernote.Clip.prototype.getRange = function() {
  if (this.hasSelection()) {
    return this.selectionFinder.getRange();
  }
  return null;
};
Evernote.Clip.prototype.getBody = function() {
  return this.window.document.getElementsByTagName('body')[0];
};
Evernote.Clip.prototype.hasBody = function() {
  try {
    var body = this.getBody();
    return body ? true : false;
  } catch (e) {
    return false;
  }
};
Evernote.Clip.prototype.hasContentToClip = function() {
  return (this.hasBody() || this.hasSelection());
};

/**
 * Captures all the content of the document
 */
Evernote.Clip.prototype.clipBody = function() {
  if (!this.hasBody()) {
    Evernote.logger.debug("Document has no body...");
    return false;
  }
  return this.clipElement(this.getBody());
};

/**
 * Captures content within an element
 *
 * @param element
 * @return
 */
Evernote.Clip.prototype.clipElement = function(element) {
  if (element && Evernote.Clip.isHtmlElement(element)) {
    var s = 0;
    var e = 0;
    if (this._verboseLog) {
      Evernote.logger.debug("Getting element contents: " + this);
      s = new Date().getTime();
    }
    this.content = this.serializeDOMNode(element, null, true);
    if (this._verboseLog) {
      e = new Date().getTime();
      Evernote.logger.debug("Clipped element contents in " + (e - s)
          + " seconds");
    }
    if (typeof this.content != 'string') {
      return false;
    }
    return true;
  } else {
    Evernote.logger.debug("Nothing to clip...");
    return false;
  }
};

/**
 * Captures selection in the document
 */
Evernote.Clip.prototype.clipSelection = function() {
  if (!this.hasSelection()) {
    Evernote.logger.debug("No selection to clip");
    return false;
  }
  // IE special case
  if (Evernote.Clip.constants.isIE) {
    this.content = this.selectionFinder.selection.htmlText;
    return true;
  }
  var s = 0;
  var e = 0;
  this.range = this.getRange();
  if (this.range) {
    if (this._verboseLog)
      var s = new Date().getTime();
    this.content = this.serializeDOMNode(this.range.commonAncestorContainer);
    if (this._verboseLog)
      var e = new Date().getTime();
    this.range = null;
    if (this._verboseLog) {
      Evernote.logger.debug("Success...");
      Evernote.logger.debug("Clipped selection in " + (e - s) + " seconds");
    }
    return true;
  }
  this.range = null;
  Evernote.logger.debug("Failed to clip selection");
  return false;
};

Evernote.Clip.prototype.clipLink = function(url, title) {
  if (typeof url != 'string') {
    url = this.window.document.location.href;
  }
  if (typeof title != 'string') {
    title = Evernote.Clip.collapseString(this.window.document.title);
  }
  this.content = "<a href='" + url + "'>" + title + "</a>";
  return true;
};

Evernote.Clip.prototype.rangeIntersectsNode = function(node) {
  if (this.range) {
    var nodeRange = node.ownerDocument.createRange();
    try {
      nodeRange.selectNode(node);
    } catch (e) {
      nodeRange.selectNodeContents(node);
    }

    return this.range.compareBoundaryPoints(Range.START_TO_END, nodeRange) == 1
        && this.range.compareBoundaryPoints(Range.END_TO_START, nodeRange) == -1;
  }
  return false;
};

Evernote.Clip.prototype.serializeDOMNode = function(node, parentNode, force) {
  if (this._verboseLog)
    Evernote.logger.debug("Clip.serializeDOMNode");
  var str = "";
  if (!force) {
    if (this.range && !this.rangeIntersectsNode(node)) {
      if (this._verboseLog)
        Evernote.logger.debug("Skipping serialization of node: "
            + node.nodeName + " cuz it's not in range...");
      return str;
    }
    if (!this.keepNode(node)) {
      if (this._verboseLog)
        Evernote.logger.debug("Skipping seralization of node: " + node.nodeName
            + " cuz it's a no-keeper");
      return str;
    }
  }
  if (this._verboseLog)
    Evernote.logger.debug("SerializeDOMNode: " + node.nodeName);
  if (node.nodeType == 3) { // Text block
    if (this._verboseLog)
      Evernote.logger.debug("Serializing text node...");
    if (this.range) {
      if (this.range.startContainer == node
          && this.range.startContainer == this.range.endContainer) {
        str += this.constructor.HTMLEncode(node.nodeValue.substring(
            this.range.startOffset, this.range.endOffset));
      } else if (this.range.startContainer == node) {
        str += this.constructor.HTMLEncode(node.nodeValue
            .substring(this.range.startOffset));
      } else if (this.range.endContainer == node) {
        str += this.constructor.HTMLEncode(node.nodeValue.substring(0,
            this.range.endOffset));
      } else if (this.range.commonAncestorContainer != node) {
        str += this.constructor.HTMLEncode(node.nodeValue);
      }
    } else {
      str += this.constructor.HTMLEncode(node.nodeValue);
    }
  } else if (node.nodeType == 1) {
    // ignore range ancestor as long as it's not a list container
    if (this.range && this.range.commonAncestorContainer == node
        && this.range.startContainer != this.range.commonAncestorContainer
        && !this.isListNode(node)) {
      if (this._verboseLog)
        Evernote.logger.debug("Ignoring range ancestor: " + node.nodeName);
    } else {
      // serialize node
      if (this._verboseLog)
        Evernote.logger.debug("Serializing node: " + node.nodeName);
      var translatedNodeName = this.translateNodeName(node);
      str += "<" + translatedNodeName;
      // include attrs
      var attrStr = this.nodeAttributesToString(node);
      if (attrStr.length > 0)
        str += " " + attrStr;
      // include style
      if (this.getStylingStrategy()) {
        if (this._verboseLog)
          Evernote.logger.debug("Styling node: " + node.nodeName);
        var nodeStyle = this.getStylingStrategy()
            .styleForNode(node, parentNode);
        if (this._verboseLog)
          Evernote.logger.debug(nodeStyle);
        if (nodeStyle instanceof Evernote.ClipStyle && nodeStyle.length > 0) {
          str += " style=\"" + nodeStyle.toString() + "\"";
        } else if (this._verboseLog) {
          Evernote.logger.debug("Empty style...");
        }
      }
      if (!node.hasChildNodes() && this.isSelfClosingNode(node)) {
        if (this._verboseLog)
          Evernote.logger.debug("Closing self-closing tag: " + node.nodeName);
        str += "/>";
      } else {
        str += ">";
      }
    }
    // recurse children
    if (node.nodeName.toLowerCase() != "iframe" && node.hasChildNodes()) {
      var children = node.childNodes;
      for ( var j = 0; j < children.length; j++) {
        var child = children[j];
        if (child != null && child.nodeType > 0 && child.nodeName != 'SCRIPT'
            && child.nodeName != 'IFRAME') {
          var childStr = this.serializeDOMNode(child, node);
          if (childStr && childStr.length > 0)
            str += childStr;
        }
      }
    }
    if (this.range && this.range.commonAncestorContainer == node
        && !this.isListNode(node)) {
      if (this._verboseLog)
        Evernote.logger.debug("Ignoring range ancestor: " + node.nodeName);
    } else if (node.hasChildNodes() || !this.isSelfClosingNode(node)) {
      str += "</" + translatedNodeName + ">";
    }
  }
  return str;
};

Evernote.Clip.prototype.keepNodeAttr = function(attrName) {
  return (typeof attrName == 'string' && typeof Evernote.Clip.NOKEEP_NODE_ATTRIBUTES[attrName
      .toLowerCase()] == 'undefined');
};
Evernote.Clip.prototype.keepNode = function(node) {
  if (node) {
    if (node.nodeType == 3) {
      return true;
    } else if (node.nodeType == 1) {
      if (node.nodeName.indexOf('#') == 0 || !this.isNodeVisible(node))
        return false;
      return (typeof Evernote.Clip.NOKEEP_NODE_NAMES[node.nodeName
          .toLowerCase()] == 'undefined' && this.nodeFilter(node));
    }
  }
  return false;
};
Evernote.Clip.prototype.nodeFilter = function(node) {
  // by default, check if there's a globaly defined nodeFilter, and use that
  if (typeof Evernote.Clip.nodeFilter == 'function') {
    return Evernote.Clip.nodeFilter(node);
  }
  return true;
};
Evernote.Clip.prototype.isNodeVisible = function(node) {
  var display = this.getNodeStylePropertyValue(node, "display");
  return (display && display != "none");
};
Evernote.Clip.prototype.isSelfClosingNode = function(node) {
  return (node && typeof Evernote.Clip.SELF_CLOSING_NODE_NAMES[node.nodeName
      .toLowerCase()] != 'undefined');
};
Evernote.Clip.prototype.isListNode = function(node) {
  return (node && node.nodeType == 1 && typeof Evernote.Clip.LIST_NODE_NAMES[node.nodeName
      .toLowerCase()] != 'undefined');
};

Evernote.Clip.prototype.nodeAttributesToString = function(node) {
  var str = "";
  var attrs = node.attributes;
  if (attrs != null) {
    for ( var i = 0; i < attrs.length; i++) {
      var a = attrs[i].nodeName.toLowerCase();
      var v = attrs[i].nodeValue;
      if (a == "href" && v.toLowerCase().indexOf("javascript:") == 0) {
        continue;
      }
      if (this.keepNodeAttr(a) && v != null && v.length > 0) {
        str += a + '=' + '"' + v + '" ';
      }
    }
  }
  return str.replace(/\s+$/, "");
};
Evernote.Clip.prototype.translateNodeName = function(node) {
  if (typeof Evernote.Clip.NODE_NAME_TRANSLATIONS[node.nodeName.toLowerCase()] != 'undefined') {
    return Evernote.Clip.NODE_NAME_TRANSLATIONS[node.nodeName.toLowerCase()];
  }
  return node.nodeName;
};

/**
 * Returns CSS style for the given node as a ClipStyle object. If computed is
 * true, the style will be computed, otherwise - it would only contain style
 * attributes matching the node.
 */
Evernote.Clip.prototype.getNodeStyle = function(node, computed, filter) {
  return Evernote.ClipStyle.getNodeStyle(node, computed, filter);
};
Evernote.Clip.prototype.getNodeStylePropertyValue = function(node, propName) {
  if (node && typeof node.nodeType == 'number' && node.nodeType == 1
      && typeof propName == 'string') {
    var doc = node.ownerDocument;
    var view = null;
    try {
      view = (doc.defaultView) ? doc.defaultView : this.window;
    } catch (e) {
      if (this._verboseLog)
        Evernote.logger.debug("Could not obtain parent window. Using default.");
      view = this.window;
    }
    if (typeof view.getComputedStyle == 'function') {
      var style = view.getComputedStyle(node, null);
      return style.getPropertyValue(propName);
    } else if (typeof node.currentStyle == 'object'
        && node.currentStyle != null) {
      return node.currentStyle[propName];
    }
  }
  return null;
};

Evernote.Clip.prototype.setStylingStrategy = function(strategy) {
  if (typeof strategy == 'function'
      && Evernote.inherits(strategy, Evernote.ClipStylingStrategy)) {
    this._stylingStrategy = new strategy(this.window);
  } else if (strategy instanceof Evernote.ClipStylingStrategy) {
    this._stylingStrategy = strategy;
  } else if (strategy == null) {
    this._stylingStrategy = null;
  }
};
Evernote.Clip.prototype.getStylingStrategy = function() {
  return this._stylingStrategy;
};

Evernote.Clip.prototype.toString = function() {
  return "Clip[" + this.location + "] " + this.title;
};

// return POSTable length of this Clip
Evernote.Clip.prototype.getLength = function() {
  var total = 0;
  var o = this.toDataObject();
  for ( var i in o) {
    total += ("" + o[i]).length + i.length + 2;
  }
  total -= 1;
  return total;
};

Evernote.Clip.prototype.toDataObject = function() {
  return {
    "content" : this.content,
    "title" : this.title,
    "url" : this.location.href,
    "fullPage" : this.isFullPage()
  };
};

/** ************** ClipStyle *************** */
/**
 * ClipStyle is a container for CSS styles. It is able to add and remove
 * CSSStyleRules (and parse CSSRuleList's for rules), as well as
 * CSSStyleDeclaration's and instances of itself.
 *
 * ClipStyle provides a mechanism to serialize itself via toString(), and
 * reports its length via length property. It also provides a method to clone
 * itself and expects to be manipulated via addStyle and removeStyle.
 */
Evernote.ClipStyle = function(css, filter) {
  this.initialize(css, filter);
};
Evernote.ClipStyle.stylePrefix = function(style) {
  if (typeof style == 'string') {
    var i = 0;
    if ((i = style.indexOf("-")) > 0) {
      return style.substring(0, i);
    }
  }
  return style;
};
Evernote.ClipStyle.prototype.length = 0;
Evernote.ClipStyle.prototype.filter = null;
Evernote.ClipStyle.prototype._verboseLog = false;
Evernote.ClipStyle.prototype.initialize = function(css, filter) {
  if (filter)
    this.setFilter(filter);
  try {
    if (CSSRuleList && css instanceof CSSRuleList) {
      if (css.length > 0) {
        for ( var i = 0; i < css.length; i++) {
          this.addStyle(css[i].style);
        }
      }
    } else if (typeof CSSStyleRule != 'undefined'
        && css instanceof CSSStyleRule) {
      this.addStyle(css.style);
    } else if (typeof CSSStyleDeclaration != 'undefined'
        && css instanceof CSSStyleDeclaration) {
      this.addStyle(css);
    } else if (typeof CSSCurrentStyleDeclaration != 'undefined'
        && css instanceof CSSCurrentStyleDeclaration) {
      this.addStyle(css);
    }
  } catch (e) {
    Evernote.logger.debug("Error initializing Evernote.ClipStyle: " + e);
  }
};
Evernote.ClipStyle.prototype.addStyle = function(style) {
  if (typeof CSSStyleDeclaration != 'undefined'
      && style instanceof CSSStyleDeclaration && style.length > 0) {
    for ( var i = 0; i < style.length; i++) {
      var prop = style[i];
      if (typeof this.filter == 'function' && !this.filter(prop)) {
        continue;
      }
      var val = style.getPropertyValue(prop);
      if (typeof this[prop] == 'undefined') {
        this.length++;
      }
      this[prop] = val;
    }
  } else if (typeof CSSCurrentStyleDeclaration != 'undefined'
      && style instanceof CSSCurrentStyleDeclaration) {
    for ( var prop in style) {
      if (typeof this.filter == 'function' && !this.filter(prop))
        continue;
      this[prop] = style[prop];
    }
  } else if (style instanceof Evernote.ClipStyle) {
    for ( var prop in style) {
      if (typeof this.constructor.prototype[prop] == 'undefined') {
        if (typeof this.filter == 'function' && !this.filter(prop)) {
          continue;
        }
        this[prop] = style[prop];
      }
    }
  } else if (typeof style == 'object' && style != null) {
    for ( var i in style) {
      if (typeof this.filter == 'function' && !this.filter(i)) {
        continue;
      }
      if (typeof style[i] != 'function'
          && typeof this.constructor.prototype[i] == 'undefined') {
        if (typeof this[i] == 'undefined') {
          this.length++;
        }
        this[i] = style[i];
      }
    }
  }
};
Evernote.ClipStyle.prototype.removeStyle = function(style, fn) {
  var self = this;
  function rem(prop, value) {
    if (typeof self[prop] != 'undefined'
        && typeof self.constructor.prototype[prop] == 'undefined'
        && (typeof fn == 'function' || self[prop] == value)) {
      if (typeof fn != 'function'
          || (typeof fn == 'function' && fn(prop, self[prop], value))) {
        if (delete (self[prop]))
          self.length--;
      }
    }
  }
  if (typeof CSSStyleDeclaration != 'undefined'
      && style instanceof CSSStyleDeclaration && style.length > 0) {
    for ( var i = 0; i < style.length; i++) {
      var prop = style[i];
      rem(prop, style.getPropertyValue(prop));
    }
  } else if (style instanceof Evernote.ClipStyle && style.length > 0) {
    for ( var prop in style) {
      rem(prop, style[prop]);
    }
  }
};
Evernote.ClipStyle.prototype.removeStyleIgnoreValue = function(style) {
  this.removeStyle(style, function(prop, propValue, value) {
    return true;
  });
};
Evernote.ClipStyle.styleInArray = function(style, styleArray) {
  if (typeof style != 'string' || !(styleArray instanceof Array))
    return false;
  var i = -1;
  var style = style.toLowerCase();
  var styleType = ((i = style.indexOf("-")) > 0) ? style.substring(0, i)
      .toLowerCase() : style.toLowerCase();
  for ( var i = 0; i < styleArray.length; i++) {
    if (styleArray[i] == style || styleArray[i] == styleType)
      return true;
  }
  return false;
};
/**
 * Derives to smaller set of style attributes by comparing differences with
 * given style and makes sure that style attributes in matchSyle are preserved.
 * This is useful for removing style attributes that are present in the parent
 * node. In that case, the instance will contain combined style attributes, and
 * the first argument to this function will be combined style attributes of the
 * parent node. The second argument will contain matched style attributes. The
 * result will contain only attributes that are free of duplicates while
 * preserving uniqueness of the style represented by this instance.
 */
Evernote.ClipStyle.prototype.deriveStyle = function(style, matchStyle,
    keepArray) {
  this.removeStyle(style, function(prop, propValue, value) {
    if (keepArray instanceof Array
        && Evernote.ClipStyle.styleInArray(prop, keepArray))
      return false;
    return (typeof matchStyle[prop] == 'undefined' && propValue == value);
  });
};
Evernote.ClipStyle.prototype.setFilter = function(filter) {
  if (typeof filter == 'function') {
    this.filter = filter;
  } else if (filter == null) {
    this.filter = null;
  }
};
Evernote.ClipStyle.prototype.getFilter = function() {
  return this.filter;
};
Evernote.ClipStyle.prototype.mergeStyle = function(style, override) {
  if (style instanceof Evernote.ClipStyle && style.length == 0) {
    for ( var i in style) {
      if (typeof this.constructor.prototype[i] != 'undefined') {
        continue;
      }
      if (typeof this[i] == 'undefined' || override) {
        this[i] = style[i];
      }
    }
  }
};
Evernote.ClipStyle.prototype.clone = function() {
  var clone = new Evernote.ClipStyle();
  for ( var prop in this) {
    if (typeof this.constructor.prototype[prop] == 'undefined') {
      clone[prop] = this[prop];
    }
  }
  clone.length = this.length;
  return clone;
};
Evernote.ClipStyle.prototype.toString = function() {
  var str = "";
  if (this.length > 0) {
    for ( var i in this) {
      if (typeof this[i] != 'string'
          || typeof this.constructor.prototype[i] != 'undefined'
          || this[i].length == 0)
        continue;
      str += i + ":" + this[i] + ";";
    }
  }
  return str;
};
Evernote.ClipStyle.getNodeStyle = function(node, computed, filter) {
  var style = new Evernote.ClipStyle();
  // Evernote.logger.debug(">>> NODE: " + node.nodeName + "/" + node.nodeType);
  if (node && typeof node.nodeType == 'number' && node.nodeType == 1) {
    var doc = node.ownerDocument;
    var view = null;
    try {
      view = (doc.defaultView) ? doc.defaultView : window;
    } catch (e) {
      Evernote.logger
          .debug("Could not obtain default view... using default window");
      view = window;
    }
    if (computed) {
      if (typeof view.getComputedStyle == 'function') {
        style = new Evernote.ClipStyle(view.getComputedStyle(node, null),
            filter);
      } else if (typeof node.currentStyle == 'object'
          && node.currentStyle != null) {
        style = new Evernote.ClipStyle(node.currentStyle, filter);
      }
    } else if (typeof view.getMatchedCSSRules == 'function') {
      // Evernote.logger.debug(">>> Getting matched rules");
      style = new Evernote.ClipStyle(view.getMatchedCSSRules(node), filter);
    } else {
      try {
        if (typeof CSSStyleDeclaration != 'undefined'
            && node.style instanceof CSSStyleDeclaration
            && node.style.length > 0) {
          style = new Evernote.ClipStyle(node.style, filter);
        }
      } catch (e) {
        // Evernote.logger.debug("Could not retrieve node style: " + e);
      }
    }
  }
  // Evernote.logger.debug(">>> " + node.nodeName + " style: " +
  // style.toString());
  return style;
};

/** ************** SelectionFinder *************** */
/**
 * SelectionFinder provides mechanism for finding selection on the page via
 * find(). It is able to traverse frames in order to find a selection. It will
 * report whether there's a selection via hasSelection(). After doing find(),
 * the selection is stored in the selection property, and the document property
 * will contain the document in which the selection was found. Find method will
 * only recurse documents if it was invoked as find(true), specifying to do
 * recursive search. You can use reset() to undo find().
 */
Evernote.SelectionFinder = function(document) {
  this.initDocument = document;
  this.document = document;
};
Evernote.SelectionFinder.prototype.initDocument = null;
Evernote.SelectionFinder.prototype.document = null;
Evernote.SelectionFinder.prototype.selection = null;

Evernote.SelectionFinder.prototype.findNestedDocuments = function(doc) {
  var documents = new Array();
  var frames = null;
  var iframes = null;
  try {
    frames = doc.getElementsByTagName("frame");
  } catch (e) {
    Evernote.logger.debug("Could not get all the frames in the document");
  }
  if (frames.length > 0) {
    for ( var i = 0; i < frames.length; i++) {
      documents.push(frames[i].contentDocument);
    }
  }
  try {
    iframes = doc.getElementsByTagName("iframe");
  } catch (e) {
    Evernote.logger.debug("Could not get all iframes in document");
  }
  try {
    if (iframes.length > 0) {
      for ( var i = 0; i < iframes.length; i++) {
        var docz = iframes[i].contentDocument;
        if (docz) {
          documents.push(docz);
        }
      }
    }
  } catch (e) {
  }
  return documents;
};
Evernote.SelectionFinder.prototype.reset = function() {
  this.document = this.initDocument;
  this.selection = null;
};
Evernote.SelectionFinder.prototype.hasSelection = function() {
  if (Evernote.Clip.constants.isIE) {
    return (this.selection && this.selection.htmlText && this.selection.htmlText.length > 0);
  }
  var range = this.getRange();
  if (range
      && (range.startContainer != range.endContainer || (range.startContainer == range.endContainer && range.startOffset != range.endOffset))) {
    return true;
  }
  return false;
};
Evernote.SelectionFinder.prototype.find = function(deep) {
  var sel = this._findSelectionInDocument(this.document, deep);
  this.document = sel.document;
  this.selection = sel.selection;
};
Evernote.SelectionFinder.prototype.getRange = function() {
  if (!this.selection || this.selection.rangeCount == 0) {
    return null;
  }
  if (typeof this.selection.getRangeAt == 'function') {
    return this.selection.getRangeAt(0);
  } else {
    var range = this.document.createRange();
    range.setStart(this.selection.anchorNode, this.selection.anchorOffset);
    range.setEnd(this.selection.focusNode, this.selection.focusOffset);
    return range;
  }
  return null;
};
Evernote.SelectionFinder.prototype._findSelectionInDocument = function(doc,
    deep) {
  var sel = null;
  var hasSelection = false;
  var win = null;
  try {
    win = (doc.defaultView) ? doc.defaultView : window;
  } catch (e) {
    Evernote.logger
        .debug("Could not retrieve default view... using default window");
    win = window;
  }
  if (typeof win.getSelection == 'function') {
    sel = win.getSelection();
    if (sel && typeof sel.rangeCount != 'undefined' && sel.rangeCount > 0) {
      hasSelection = true;
    }
  } else if (win.selection && typeof win.selection.createRange == 'function') {
    sel = win.selection.createRange();
    if (typeof win.selection.type == 'Text' && typeof sel.htmlText == 'string'
        && sel.htmlText.length > 0) {
      hasSelection = true;
    }
  } else if (doc.selection && doc.selection.createRange) {
    sel = doc.selection.createRange();
    if (typeof doc.selection.type == 'Text' && typeof sel.htmlText == 'string'
        && sel.htmlText.length > 0) {
      hasSelection = true;
    }
  }
  if (sel && !hasSelection && deep) {
    Evernote.logger.debug("Empty range, trying frames");
    var nestedDocs = this.findNestedDocuments(doc);
    Evernote.logger.debug("# of nested docs: " + nestedDocs.length);
    if (nestedDocs.length > 0) {
      for ( var i = 0; i < nestedDocs.length; i++) {
        if (nestedDocs[i]) {
          Evernote.logger.debug("Trying nested doc: " + nestedDocs[i]);
          var framedSel = this._findSelectionInDocument(nestedDocs[i], deep);
          if (framedSel && framedSel.selection
              && framedSel.selection.rangeCount > 0) {
            return framedSel;
          }
        }
      }
    }
  }
  return {
    document : doc,
    selection : sel
  };
};

/** ************** ClipStylingStrategy *************** */
Evernote.ClipStylingStrategy = function(window) {
  this.initialize(window);
};
Evernote.ClipStylingStrategy.prototype._verboseLog = false;

Evernote.ClipStylingStrategy.prototype.initialize = function(window) {
  this.window = window;
};
Evernote.ClipStylingStrategy.prototype.styleForNode = function(node, parentNode) {
  return null;
};
Evernote.ClipStylingStrategy.prototype.getNodeStyle = function(node, computed,
    filter) {
  return Evernote.ClipStyle.getNodeStyle(node, computed, filter);
};

Evernote.ClipTextStylingStrategy = function(window) {
  this.initialize(window);
};
Evernote
    .inherit(Evernote.ClipTextStylingStrategy, Evernote.ClipStylingStrategy);
Evernote.ClipTextStylingStrategy.FORMAT_NODE_NAMES = {
  "b" : null,
  "big" : null,
  "em" : null,
  "i" : null,
  "small" : null,
  "strong" : null,
  "sub" : null,
  "sup" : null,
  "ins" : null,
  "del" : null,
  "s" : null,
  "strike" : null,
  "u" : null,
  "code" : null,
  "kbd" : null,
  "samp" : null,
  "tt" : null,
  "var" : null,
  "pre" : null,
  "listing" : null,
  "plaintext" : null,
  "xmp" : null,
  "abbr" : null,
  "acronym" : null,
  "address" : null,
  "bdo" : null,
  "blockquote" : null,
  "q" : null,
  "cite" : null,
  "dfn" : null
};
Evernote.ClipTextStylingStrategy.STYLE_ATTRS = {
  "font" : null,
  "text" : null,
  "color" : null
};
Evernote.ClipTextStylingStrategy.prototype.isFormatNode = function(node) {
  return (node && node.nodeType == 1 && typeof Evernote.ClipTextStylingStrategy.FORMAT_NODE_NAMES[node.nodeName
      .toLowerCase()] != 'undefined');
};
Evernote.ClipTextStylingStrategy.prototype.hasTextNodes = function(node) {
  if (node && node.nodeType == 1 && node.childNodes.length > 0) {
    for ( var i = 0; i < node.childNodes.length; i++) {
      if (node.childNodes[i].nodeType == 3) {
        if (this._verboseLog) {
          Evernote.logger.debug("Node " + node.nodeName + " has text nodes");
        }
        return true;
      }
    }
  }
  return false;
};
Evernote.ClipTextStylingStrategy.prototype.styleFilter = function(style) {
  var s = Evernote.ClipStyle.stylePrefix(style.toLowerCase());
  if (typeof Evernote.ClipTextStylingStrategy.STYLE_ATTRS[s] != 'undefined') {
    return true;
  } else if (this._verboseLog) {
    Evernote.logger.debug("Filter excluding: " + style);
  }
};
Evernote.ClipTextStylingStrategy.prototype.styleForNode = function(node,
    parentNode) {
  var nodeStyle = null;
  if (this.isFormatNode(node) || this.hasTextNodes(node)) {
    nodeStyle = this.getNodeStyle(node, true, this.styleFilter);
  }
  return nodeStyle;
};

Evernote.ClipFullStylingStrategy = function(window) {
  this.initialize(window);
};
Evernote
    .inherit(Evernote.ClipFullStylingStrategy, Evernote.ClipStylingStrategy);
Evernote.ClipFullStylingStrategy.ALWAYS_KEEP = {
  "*" : [ "font", "text", "color", "margin", "padding" ],
  "img" : [ "width", "height", "border" ],
  "li" : [ "list", "margin", "padding" ],
  "ul" : [ "list", "margin", "padding" ],
  "dl" : [ "margin", "padding" ],
  "dt" : [ "margin", "padding" ],
  "h1" : [ "margin", "padding" ],
  "h2" : [ "margin", "padding" ],
  "h3" : [ "margin", "padding" ],
  "h4" : [ "margin", "padding" ],
  "h5" : [ "margin", "padding" ],
  "h6" : [ "margin", "padding" ],
  "h7" : [ "margin", "padding" ],
  "h8" : [ "margin", "padding" ],
  "h9" : [ "margin", "padding" ],
  "form" : [ "height", "width", "margin", "padding" ]
};
Evernote.ClipFullStylingStrategy.prototype.styleForNode = function(node,
    parentNode) {
  var nodeStyle = null;
  if (node && node.nodeType == 1) {
    nodeStyle = this.getNodeStyle(node, true);
    if (parentNode) {
      if (this._verboseLog)
        Evernote.logger.debug("Deriving style...");
      var nodeMatchedStyle = this.getNodeStyle(node, false);
      var parentStyle = this.getNodeStyle(parentNode, true);
      var keepers = (typeof Evernote.ClipFullStylingStrategy.ALWAYS_KEEP[node.nodeName
          .toLowerCase()] != 'undefined') ? Evernote.ClipFullStylingStrategy.ALWAYS_KEEP[node.nodeName
          .toLowerCase()]
          : Evernote.ClipFullStylingStrategy.ALWAYS_KEEP["*"];
      nodeStyle.deriveStyle(parentStyle, nodeMatchedStyle, keepers);
    }
  }
  return nodeStyle;
};

/** ************** Evernote.CSSSelector *************** */
Evernote.CSSSelector = function(selectorText) {
  this.initialize(selectorText);
};
Evernote.CSSSelector.P_TAGNAME = 1;
Evernote.CSSSelector.P_TAGTYPE = 2;
Evernote.CSSSelector.P_ID = 3;
Evernote.CSSSelector.P_CLASS = 4;
Evernote.CSSSelector.P_START_ATTR = 5;
Evernote.CSSSelector.P_ATTR_KVSEP = 6;
Evernote.CSSSelector.P_END_ATTR = 7;
Evernote.CSSSelector.P_MODIFIER = 8;
Evernote.CSSSelector.fromString = function(str) {
  return new Evernote.CSSSelector(str);
};
Evernote.CSSSelector.fromElement = function(element) {
  var s = new Evernote.CSSSelector();
  if (typeof element.nodeName == 'string')
    s.tagName = element.nodeName.toLowerCase();
  try {
    var attrs = element.attributes;
    for ( var i = 0; i < attrs.length; i++) {
      var attr = attrs[i];
      var attrName = attr.name.toLowerCase();
      if (attrName == "id" && attr.value) {
        s.id = attr.value;
      } else if (attrName == "class" && attr.value) {
        s.classes = attr.value.replace(/\s+/, " ").split(" ");
      } else if (s.attributes instanceof Array) {
        s.attributes.push( {
          name : attrName,
          value : attr.value
        });
      } else {
        s.attributes = [ {
          name : attrName,
          value : attr.value
        } ];
      }
    }
  } catch (e) {
  }
  return s;
};
Evernote.CSSSelector.prototype.tagName = null;
Evernote.CSSSelector.prototype.tagType = null;
Evernote.CSSSelector.prototype.id = null;
Evernote.CSSSelector.prototype.classes = null;
Evernote.CSSSelector.prototype.attributes = null;
Evernote.CSSSelector.prototype.modifier = null;
Evernote.CSSSelector.prototype.initialize = function(selectorText) {
  if (typeof selectorText == 'string')
    this.parse(selectorText);
};
Evernote.CSSSelector.prototype.reset = function() {
  this.tagName = null;
  this.tagType = null;
  this.id = null;
  this.classes = null;
  this.attributes = null;
  this.modifier = null;
};
Evernote.CSSSelector.prototype.parse = function(str) {
  var i = 0;
  var cur = Evernote.CSSSelector.P_TAGNAME;
  str = Evernote.trim(str);
  this.reset();
  while (i < str.length) {
    var c = str.charAt(i);
    if (c == ":") {
      cur = (i == 0) ? Evernote.CSSSelector.P_TAGTYPE
          : Evernote.CSSSelector.P_MODIFIER;
    } else if (c == "#") {
      cur = Evernote.CSSSelector.P_ID;
    } else if (c == ".") {
      cur = Evernote.CSSSelector.P_CLASS;
      if (!this.classes) {
        this.classes = new Array();
      }
      this.classes.push("");
    } else if (c == "[") {
      cur = Evernote.CSSSelector.P_START_ATTR;
      if (!this.attributes)
        this.attributes = new Array();
      this.attributes.push( {
        name : "",
        value : null
      });
    } else if (c == "=" && cur == Evernote.CSSSelector.P_START_ATTR) {
      cur = Evernote.CSSSelector.P_ATTR_KVSEP;
    } else if (c == "]") {
      cur = Evernote.CSSSelector.P_END_ATTR;
    } else {
      if (cur == Evernote.CSSSelector.P_TAGTYPE) {
        this.tagType = (this.tagType) ? this.tagType + c : c;
      } else if (cur == Evernote.CSSSelector.P_TAGNAME && c != "*") {
        this.tagName = (this.tagName) ? this.tagName + c.toLowerCase() : c
            .toLowerCase();
      } else if (cur == Evernote.CSSSelector.P_ID) {
        this.id = (this.id) ? this.id + c : c;
      } else if (cur == Evernote.CSSSelector.P_CLASS) {
        this.classes[this.classes.length - 1] += c;
      } else if (cur == Evernote.CSSSelector.P_START_ATTR) {
        var last = this.attributes[this.attributes.length - 1];
        last["name"] += c.toLowerCase();
      } else if (cur == Evernote.CSSSelector.P_ATTR_KVSEP) {
        var last = this.attributes[this.attributes.length - 1];
        last["value"] = (last["value"]) ? last["value"] + c : c;
      } else if (cur == Evernote.CSSSelector.P_MODIFIER) {
        this.modifier = (this.modifier) ? this.modifier + c : c;
      }
    }
    i += 1;
  }
  this.update();
};
Evernote.CSSSelector.prototype.update = function() {
  // clean up
  if (this.classes) {
    Evernote.cleanArray(this.classes, function(val) {
      return (typeof val != 'string' || Evernote.trim(val).length == 0);
    });
    if (this.classes.length == 0) {
      this.classes = null;
    } else {
      this.classes.sort();
    }
  }
  if (this.attributes) {
    Evernote
        .cleanArray(this.attributes,
            function(val) {
              return (typeof val["name"] != 'string' || Evernote
                  .trim(val["name"]).length == 0);
            });
    if (this.attributes.length == 0) {
      this.attributes = null;
    } else {
      this.attributes.sort(function(a, b) {
        return a.name > b.name;
      });
    }
  }
};
Evernote.CSSSelector.prototype.getAttributeMap = function() {
  var attrs = {};
  if (this.attributes) {
    for ( var i = 0; i < this.attributes.length; i++) {
      attrs[this.attributes[i].name] = this.attributes[i].value;
    }
  }
  return attrs;
};
Evernote.CSSSelector.prototype.appliesTo = function(cssSelectorOrElement) {
  var o = null;
  if (cssSelectorOrElement instanceof Evernote.CSSSelector) {
    o = cssSelectorOrElement;
  } else if (typeof cssSelectorOrElement == 'string') {
    o = Evernote.CSSSelector.fromString(cssSelectorOrElement);
  } else if (typeof cssSelectorOrElement == 'object'
      && cssSelectorOrElement != null
      && typeof cssSelectorOrElement.nodeName == 'string') {
    o = Evernote.CSSSelector.fromElement(cssSelectorOrElement);
  } else {
    o = new Evernote.CSSSelector();
  }
  if (this.tagName && this.tagName != o.tagName)
    return false;
  if (this.tagType != o.tagType)
    return false;
  if (this.id && (this.id != o.id)) {
    return false;
  }
  if (this.classes && o.classes) {
    for ( var i = 0; i < this.classes.length; i++) {
      if (o.classes.indexOf(this.classes[i]) < 0)
        return false;
    }
  } else if (this.classes && !o.classes) {
    return false;
  }
  if (this.attributes && o.attributes) {
    var oAttrs = o.getAttributeMap();
    for ( var i = 0; i < this.attributes.length; i++) {
      if (typeof oAttrs[this.attributes[i].name] == 'undefined') {
        return false;
      }
    }
  } else if (this.attributes && !o.attributes) {
    return false;
  }
  if (this.modifier && this.modifier != o.modifier) {
    return false;
  }
  return true;
};
Evernote.CSSSelector.prototype.toString = function() {
  var str = "";
  if (this.tagType) {
    str += ":" + this.tagType;
  } else if (this.tagName) {
    str += this.tagName;
  }
  if (this.id) {
    str += "#" + this.id;
  }
  if (this.classes && this.classes.length > 0) {
    str += "." + this.classes.join(".");
  }
  if (this.attributes && this.attributes.length > 0) {
    for ( var i = 0; i < this.attributes.length; i++) {
      str += "[" + this.attributes[i].name + "=" + this.attributes[i].value
          + "]";
    }
  }
  if (this.modifier) {
    str += ":" + this.modifier;
  }
  return str;
};

/** ************** AJAX Support *************** */
Evernote.Ajax = {
  options : {
    async : true,
    type : "GET",
    data : null,
    success : null,
    error : null,
    context : null,
    complete : null,
    timeout : 10000
  },
  getXhr : function() {
    if (window.XMLHttpRequest
        && (window.location.protocol !== "file:" || !window.ActiveXObject)) {
      return new window.XMLHttpRequest();
    } else {
      try {
        return new window.ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
      }
    }
    return null;
  },
  doRequest : function(options) {
    var opts = Evernote.extend(true, {}, this.options,
        ((typeof options == 'object' && options != null) ? options : {}));
    var xhr = this.getXhr();
    xhr.open(opts.type, opts.url, opts.async);
    opts.context = (opts.context) ? opts.context : this;
    var success = function(data, statusText, xhr) {
      if (typeof opts.success == 'function') {
        opts.success.apply(opts.context, [ data, statusText, xhr ]);
      }
    };
    var error = function(xhr, statusText, error) {
      if (typeof opts.error == 'function') {
        opts.error.apply(opts.context, [ xhr, statusText, error ]);
      }
    };
    var complete = (typeof opts.complete == 'function') ? opts.complete
        : function(xhr, textStatus) {
          if (xhr.status == 200)
            success(xhr.responseText, textStatus, xhr);
          else
            error(xhr, textStatus, null);
        };
    if (opts.async) {
      // bind listener
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          complete(xhr, xhr.statusText);
        }
      };
    }
    if (opts.timeout) {
      setTimeout(function() {
        if (xhr && xhr.readyState < 4) {
          xhr.abort();
          error(xhr, xhr.statusText, 'timeout');
        }
      }, opts.timeout);
    }
    if (!opts.async) {
      try {
        xhr.send(opts.data);
        complete(xhr, xhr.statusText);
      } catch (e) {
        error(xhr, xhr.statusText, e);
      }
    } else {
      try {
        xhr.send(opts.data);
      } catch (e) {
        error(xhr, xhr.statusText, e);
      }
    }
  },
  get : function(options) {
    var opts = (typeof options == 'object' && options != null) ? options : {};
    opts.type = "GET";
    this.doRequest(options);
  }
};

/** ************** Utility Methods *************** */
Evernote.CLIP_OPTIONS = {
  // URL that will be associated with the clip (will be assigned to the
  // sourceURL attribute of the note)
  url : null,
  // Title for the clip
  title : null,
  // signature (HTML or DOM Element) that will be appended to the note,
  // separated by horizontal rule
  signature : null,
  // header (HTML or DOM Element) that will be prepended to the content
  header : null,
  // footer (HTML or DOM Element) that will be appended to the content
  footer : null,
  // content (HTML or DOM Element) that will be the content of the clip
  content : null,
  // id of the DOM Element whose contents will become the content of the clip
  contentId : null,
  // URL from which to retrieve content to be clipped
  contentUrl : null,
  // optional function used to filter which DOM elements get included when
  // serializing DOM. This function will be passed a single argument - the DOM
  // element, and if the function return a truthful result - the passed DOM
  // element will be serialized, otherwise it will be skipped.
  filter : null,
  // comma-separated list of tag names
  suggestTags : null,
  // notebook name
  suggestNotebook : null,
  // friendly name for the content provider (defaults to source URL)
  providerName : null,
  // partner code
  code : null,
  // latitude and longitude coordinates (optional, and if specified, should be
  // floats)
  latitude : null,
  longitude : null,
  // DOM styling strategy (accepts 'none', 'text', 'full' or actual implementing
  // Function)
  styling : Evernote.ClipTextStylingStrategy
};
Evernote.CLIP_WINDOW_ATTRIBUTES = {
  windowUrl : "",
  windowName : "evernoteClipWindow",
  windowOptions : "width=500,height=480,scrollbars=yes,resizable=yes"
};
Evernote.CLIP_FORM_ATTRIBUTES = {
  action : Evernote.Config.getClipUrl(),
  method : "post",
  enctype : "multipart/form-data",
  encoding : "multipart/form-data", // cuz IE is special
  "accept-charset" : "UTF-8",
  id : "evernoteClipForm",
  target : Evernote.CLIP_WINDOW_ATTRIBUTES.windowName
};
Evernote.extend = function() {
  var args = arguments;
  var recurse = false;
  var initialIndex = 0;
  if (typeof args[0] == 'boolean') {
    recurse = args[0];
    initialIndex = 1;
  }
  var rootObj = args[initialIndex];
  for ( var i = (initialIndex + 1); i < args.length; i++) {
    if (typeof args[i] == 'object' && args[i] != null) {
      for ( var j in args[i]) {
        if (typeof args[i][j] == 'object' && args[i][j] != null && recurse) {
          Evernote.extend(true, (typeof rootObj[j] != 'undefined') ? rootObj[j]
              : {}, args[i][j]);
        } else {
          rootObj[j] = args[i][j];
        }
      }
    }
  }
  return rootObj;
};
Evernote.trim = function(str) {
  if (typeof str == 'string') {
    return str.replace(/^[\s\t]+/, "").replace(/[\s\t]+$/, "");
  }
  return str;
};
Evernote.cleanString = function(str) {
  if (typeof str == 'string') {
    return Evernote.trim(str);
  }
  return "";
};
Evernote.concatArrays = function() {
  if (arguments.length <= 1) {
    return arguments[0];
  }
  var args = new Array();
  for ( var i = 0; i < arguments.length; i++) {
    args.push(arguments[i]);
  }
  if (typeof Array.prototype.concat == 'function') {
    return args[0].concat.apply(args[0], args.slice(1));
  } else {
    for ( var i = 1; i < args.length; i++) {
      var a = args[i];
      for ( var ii = 0; ii < a.length; ii++) {
        args[0].push(a[ii]);
      }
    }
    return args[0];
  }
};
Evernote.createClipForm = function(clip, options) {
  var opts = Evernote.extend( {}, Evernote.CLIP_OPTIONS,
      (typeof options == 'object' && options != null) ? options : {});
  var form = document.createElement("form");
  for ( var a in Evernote.CLIP_FORM_ATTRIBUTES) {
    if (typeof Evernote.CLIP_FORM_ATTRIBUTES[a] == 'function') {
      form.setAttribute(a, Evernote.CLIP_FORM_ATTRIBUTES[a]());
    } else if (Evernote.CLIP_FORM_ATTRIBUTES[a] != null) {
      form.setAttribute(a, Evernote.CLIP_FORM_ATTRIBUTES[a]);
    }
  }
  form.style.display = "none";
  var url = (opts['url']) ? opts['url'] : clip.location.href;
  if (!url)
    url = document.location.href;
  var title = (opts['title']) ? opts['title'] : clip.title;
  if (!title)
    title = document.title;
  var formData = {
    title : Evernote.cleanString(title),
    htmlTitle: Evernote.Clip.unicodeEntities(Evernote.cleanString(title)),
    url : Evernote.cleanString(url),
    suggestTags : Evernote.cleanString(opts['suggestTags']),
    suggestNotebook : Evernote.cleanString(opts['suggestNotebook']),
    code : Evernote.cleanString(opts['code']),
    providerName : Evernote.cleanString(opts['providerName'])
  };
  // since IE doesn't deal properly with accept-charset,
  // we encode unicode chars in all of the relevant form data using html entities,
  // and inform the server about changed charset
  if (Evernote.Clip.constants.isIE) {
    var encAttrs = ["title", "suggestTags", "suggestNotebook", "providerName"];
    for (var i=0; i<encAttrs.length; i++) {
      formData[encAttrs[i]] = Evernote.Clip.unicodeEntities(formData[encAttrs[i]]);
    }
    formData["charset"] = "htmlentities";
  }
  var lat = parseFloat(opts.latitude);
  var lon = parseFloat(opts.longitude);
  if (typeof lat == 'number' && !isNaN(lat) && lat >= -90 && lat <= 90
      && typeof lon == 'number' && !isNaN(lon) && lon >= -180 && lon <= 180) {
    formData["latitude"] = lat;
    formData["longitude"] = lon;
  }
  if (clip && clip instanceof Evernote.Clip) {
    formData.content = clip.content;
  }
  for ( var i in formData) {
    var e = document.createElement("input");
    e.setAttribute("type", "hidden");
    e.setAttribute("name", i);
    e.value = formData[i];
    Evernote.logger.debug(e);
    form.appendChild(e);
  }
  return form;
};
Evernote.createClip = function(options) {
  var opts = Evernote.extend( {}, Evernote.CLIP_OPTIONS,
      (typeof options == 'object' && options != null) ? options : {});
  if (typeof opts.styling == 'string') {
    switch (opts.styling.toLowerCase()) {
      case "none":
        opts.styling = null;
        break;
      case "text":
        opts.styling = Evernote.ClipTextStylingStrategy;
        break;
      case "full":
        opts.styling = Evernote.ClipFullStylingStrategy;
        break;
      default:
        opts.styling = Evernote.ClipTextStylingStrategy;
    }
  }
  var clip = new Evernote.Clip(window, opts.styling);
  if (typeof opts.filter == 'function') {
    clip.nodeFilter = opts.filter;
  } else if (typeof opts.filter == 'string') {
    try {
      var _noteit_temp_F = undefined;
      eval("var _noteit_temp_F = " + opts.filter);
      if (typeof _noteit_temp_F == 'function') {
        clip.nodeFilter = _noteit_temp_F;
      }
    } catch (e) {
    }
  }
  var contentElement = null;
  if (typeof opts.content == 'string') {
    clip.content = opts.content;
  } else if (Evernote.Clip.isHtmlElement(opts.content)) {
    clip.clipElement(opts.content);
  } else if (typeof opts.contentId == 'string'
      && (contentElement = window.document.getElementById(opts.contentId))) {
    clip.clipElement(contentElement);
  } else if (typeof opts.contentUrl == 'string') {
    Evernote.Ajax.get( {
      url : opts.contentUrl,
      async : false,
      success : function(data, status, xhr) {
        clip.content = data;
      },
      error : function(xhr, status, error) {
        alert("Error retrieving clip content!");
        clip.content = "";
      }
    });
  } else {
    // no content was specified - use BODY tag and if that cannot be found for
    // some reason, just make a link-only note
    contentElement = document.getElementsByTagName("BODY")[0];
    if (contentElement) {
      clip.clipElement(contentElement);
    } else {
      // something went terribly wrong and we don't know what to clip
      clip.clipLink(opts.url, opts.title);
    }
  }
  // custom signature
  if (opts.signature) {
    if (typeof opts.signature == 'string') {
      clip.content += "<hr/>" + opts.signature;
    } else if (Evernote.Clip.isHtmlElement(opts.signature)) {
      var signatureClip = new Evernote.Clip(window, opts.styling);
      signatureClip.clipElement(opts.signature);
      if (signatureClip.content) {
        clip.content += "<hr/>" + signatureClip.content;
      }
    }
  }
  // custom header
  if (opts.header) {
    if (typeof opts.header == 'string') {
      clip.content = opts.header + clip.content;
    } else if (Evernote.Clip.isHtmlElement(opts.header)) {
      var headerClip = new Evernote.Clip(window, opts.styling);
      headerClip.clipElement(opts.header);
      if (headerClip.content) {
        clip.content = headerClip.content + clip.content;
      }
    }
  }
  // custom footer
  if (opts.footer) {
    if (typeof opts.header == 'string') {
      clip.content += opts.footer;
    } else if (Evernote.Clip.isHtmlElement(opts.footer)) {
      var footerClip = new Evernote.Clip(window, opts.styling);
      footerClip.clipElement(opts.footer);
      if (footerClip.content) {
        clip.content += footerClip.content;
      }
    }
  }
  return clip;
};
Evernote.doClip = function(options) {
  var opts = (typeof options == 'object' && options != null) ? options : {};
  if (typeof opts.content == 'undefined'
      && typeof opts.contentId == 'undefined'
      && typeof opts.contentUrl == 'undefined') {
    if (typeof opts.filter != 'function') {
      opts.filter = function(el) {
        // try not to clip the element that got clicked to make a clip in the
        // first place
        if (typeof event == 'object' && event != null && event.target
            && el == event.target) {
          return false;
        }
        // skip any markers we know of
        for ( var i = 0; i < Evernote.Clip.filterMarkers.length; i++) {
          if (Evernote.containsElementId(el, Evernote.Clip.filterMarkers[i])
              || Evernote.containsElementClass(el,
                  Evernote.Clip.filterMarkers[i])) {
            return false;
          }
        }
        return true;
      };
    }
    var classMarkedElements = [];
    opts.content = (typeof event == 'object' && event != null && event.target) ? Evernote
        .findParent(event.target, function(el) {
          if (!Evernote.isHtmlElement(el)) {
            return false;
          }
          for ( var i = 0; i < Evernote.Clip.contentMarkers.length; i++) {
            if (Evernote.isElementVisible(el) && opts.filter(el)) {
              if (Evernote.containsElementClass(el,
                  Evernote.Clip.contentMarkers[i])) {
                classMarkedElements.push(el);
              }
              if (Evernote.containsElementId(el,
                  Evernote.Clip.contentMarkers[i])
                  || Evernote.hasElementClass(el,
                      Evernote.Clip.contentMarkers[i])) {
                opts.styling = 'full';
                return true;
              }
            }
          }
          return false;
        })
        : document.getElementsByTagName("BODY")[0];
    if (!opts.content && classMarkedElements.length > 0) {
      opts.content = classMarkedElements[classMarkedElements.length - 1];
    } else if (classMarkedElements.length > 0) {
      var topClassMarkedElement = classMarkedElements[classMarkedElements.length - 1];
      var topClassMarkedClassNames = Evernote
          .getElementClassNames(topClassMarkedElement);
      var classMarkedChildren = Evernote.findChildren(opts.content,
          function(el) {
            for ( var i = 0; i < topClassMarkedClassNames.length; i++) {
              if (Evernote.hasElementClass(el, topClassMarkedClassNames[i]))
                return true;
            }
            return false;
          }, true);
      if (classMarkedChildren.length > 1) {
        opts.content = topClassMarkedElement;
      }
    }
  }
  var clip = Evernote.createClip(opts);
  var oldForm = document.getElementById(Evernote.CLIP_FORM_ATTRIBUTES.id);
  if (oldForm) {
    oldForm.parentNode.removeChild(oldForm);
  }
  var form = Evernote.createClipForm(clip, opts);
  var body = document.getElementsByTagName("body")[0];
  var postWindow = window.open(Evernote.CLIP_WINDOW_ATTRIBUTES.windowUrl,
      Evernote.CLIP_WINDOW_ATTRIBUTES.windowName,
      Evernote.CLIP_WINDOW_ATTRIBUTES.windowOptions);
  if (body) {
    var oldForm = document.getElementById(Evernote.CLIP_FORM_ATTRIBUTES["id"]);
    if (typeof oldForm == 'object' && oldForm != null
        && typeof oldForm.parentNode == 'object'
        && typeof oldForm.parentNode != null) {
      oldForm.parentNode.removeChild(oldForm);
    }
    body.appendChild(form);
    form.submit();
    try {
      postWindow.window.focus();
    } catch (e) {
    }
  }
};