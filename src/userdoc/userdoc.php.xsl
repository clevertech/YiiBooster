<xsl:stylesheet
        version="2.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:ctboost="http://yii-booster.clevertech.biz/UserDocumentationSchema"
        exclude-result-prefixes="ctboost">

    <xsl:function name="ctboost:makeSectionId">
        <xsl:param name="sectionName" />
        <xsl:value-of select="replace(normalize-space(replace(lower-case($sectionName), '[^a-zA-Z0-9]', ' ')), ' ', '-')" />
    </xsl:function>
    <xsl:function name="ctboost:makeWidgetCode">
        <xsl:param name="widgetClassName" />
        <xsl:value-of select="replace(lower-case($widgetClassName), '^tb', '')" />
    </xsl:function>
    <xsl:function name="ctboost:ucfirst">
        <xsl:param name="word" />
        <xsl:value-of select="concat(upper-case(substring($word,1,1)),
          substring($word, 2),
          ' '[not(last())])" />
    </xsl:function>
    <xsl:function name="ctboost:yiidoc">
        <xsl:param name="link" />
        <xsl:value-of select="replace(replace($link, '::|\.', '.'), '\.([a-zA-Z0-9]+)$', '#$1-detail')" />
    </xsl:function>
    <xsl:variable name="widgetname" select="documentation/@for" />
    <xsl:variable name="widgetcode" select="ctboost:makeWidgetCode($widgetname)" />


    <xsl:template match="/">
        <xsl:processing-instruction name="php">
            <xsl:text>
/**
 * End-user documentation for </xsl:text>
            <xsl:value-of select="$widgetname" />
            <xsl:text> widget.
 *
 * @var WidgetsController $this
 */

$this->header = '</xsl:text>
            <xsl:value-of select="$widgetname" />
            <xsl:text>';
$this->subheader = '</xsl:text>
            <xsl:value-of select="documentation/@punchline" />
            <xsl:text>';

$this->menu = array(</xsl:text>
            <xsl:for-each select="//section">
                <xsl:variable name="sectionid" select="ctboost:makeSectionId(@named)" />

                <xsl:text>
    '</xsl:text>
                <xsl:value-of select="$sectionid" />
                <xsl:text>' => '</xsl:text>
                <xsl:value-of select="@named" />
                <xsl:text>',</xsl:text>

            </xsl:for-each>
            <xsl:text>
);
</xsl:text>
        </xsl:processing-instruction>

        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="section">
        <section>
            <xsl:attribute name="id">
                <xsl:value-of select="ctboost:makeSectionId(@named)" />
            </xsl:attribute>

            <div class="page-header">
                <h1><xsl:value-of select="@named" /></h1>
            </div>

            <xsl:apply-templates />
        </section>

    </xsl:template>

    <xsl:template match="example">
        <xsl:processing-instruction name="php">
            <xsl:text>$this->widget('Example', array('name' => '</xsl:text>
            <xsl:value-of select="$widgetcode" />
            <xsl:text>.</xsl:text>
            <xsl:value-of select="@name" />
            <xsl:text>'));</xsl:text>
        </xsl:processing-instruction>
    </xsl:template>

    <xsl:template match="p">
        <p><xsl:apply-templates /></p>
    </xsl:template>

    <xsl:template match="a">
        <a>
            <xsl:attribute name="href" select="@href" />
            <xsl:value-of select="." />
        </a>
    </xsl:template>
    <xsl:template match="p[@label]">
        <p>
            <xsl:call-template name="label">
                <xsl:with-param name="label" select="@label" />
                <xsl:with-param name="caption" select="ctboost:ucfirst(@label)" />
            </xsl:call-template>

            <xsl:text> </xsl:text>
            <xsl:apply-templates />
        </p>
    </xsl:template>

    <xsl:template match="p[@label=volatile]">
        <p>
            <xsl:call-template name="label">
                <xsl:with-param name="label" select="'warning'" />
                <xsl:with-param name="caption" select="'Volatile'" />
                <xsl:with-param name="tooltip" select="'Suspect for renaming in future versions.'" />
            </xsl:call-template>

            <xsl:text> </xsl:text>
            <xsl:apply-templates />
        </p>
    </xsl:template>

    <xsl:template match="p[@label=deprecated]">
        <p>
            <xsl:call-template name="label">
                <xsl:with-param name="label" select="'error'" />
                <xsl:with-param name="caption" select="'Deprecated'" />
                <xsl:with-param name="tooltip" select="'Do not use it in any new code and try to remove usage of it in existing code.'" />
            </xsl:call-template>

            <xsl:text> </xsl:text>
            <xsl:apply-templates />
        </p>
    </xsl:template>

    <xsl:template match="p[@label=internal]">
        <p>
            <xsl:call-template name="label">
                <xsl:with-param name="label" select="'info'" />
                <xsl:with-param name="caption" select="'Internal'" />
                <xsl:with-param name="tooltip" select="'You are not expected to change this property in normal usage.'" />
            </xsl:call-template>

            <xsl:text> </xsl:text>
            <xsl:apply-templates />
        </p>
    </xsl:template>

    <xsl:template match="label" name="label">
        <xsl:param name="label" />
        <xsl:param name="caption" />
        <xsl:param name="tooltip" />
        <span>
            <xsl:attribute name="class">
                <xsl:text>label label-</xsl:text>
                <xsl:value-of select="$label" />
            </xsl:attribute>

            <xsl:value-of select="$caption" />

            <xsl:if test="string-length($tooltip) &gt; 0">
                <xsl:attribute name="data-toggle">
                    <xsl:text>tooltip</xsl:text>
                </xsl:attribute>
                <xsl:attribute name="title">
                    <xsl:value-of select="$tooltip" />
                </xsl:attribute>
            </xsl:if>
        </span>
    </xsl:template>

    <xsl:template match="ln">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

    <xsl:template match="wn">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

    <xsl:template match="pn">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

    <xsl:template match="subheader">
        <h2>
            <xsl:if test="string-length(@id) &gt; 0">
                <xsl:attribute name="id" select="@id" />
            </xsl:if>
            <xsl:apply-templates />
        </h2>
    </xsl:template>

    <xsl:template match="yiidoc">
        <a>
            <xsl:attribute name="href">
                <xsl:text>http://www.yiiframework.com/doc/api/</xsl:text>
                <xsl:value-of select="ctboost:yiidoc(.)" />
            </xsl:attribute>
            <xsl:value-of select="." />
        </a>
    </xsl:template>

    <xsl:template match="properties">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <xsl:apply-templates />
            </tbody>
        </table>
    </xsl:template>

    <xsl:template match="property">
        <tr>
            <xsl:attribute name="id" select="concat('pn-', @name)"/>
            <td>
                <code>
                    <xsl:value-of select="@name" />
                    <xsl:text> </xsl:text>
                    <strong>
                        <xsl:value-of select="@type" />
                    </strong>
                    <xsl:text> </xsl:text>
                    <em>
                        <xsl:text>= </xsl:text>
                        <xsl:value-of select="@default" />
                    </em>
                </code>
            </td>
            <td>
                <xsl:apply-templates />
            </td>
        </tr>
    </xsl:template>

    <xsl:template match="em">
        <em>
            <xsl:value-of select="." />
        </em>
    </xsl:template>

    <xsl:template match="github-issue">
        <a>
            <xsl:attribute name="href">
                <xsl:text>https://github.com/clevertech/YiiBooster/issues/</xsl:text>
                <xsl:value-of select="@id"/>
            </xsl:attribute>
            <xsl:text>issue #</xsl:text>
            <xsl:value-of select="@id" />
            <xsl:text> at GitHub</xsl:text>
        </a>
    </xsl:template>
</xsl:stylesheet>